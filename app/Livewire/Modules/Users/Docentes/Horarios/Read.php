<?php

namespace App\Livewire\Modules\Users\Docentes\Horarios;

use App\Models\creditosAlumnos;
use App\Models\horariosAlumnos;
use App\Models\horariosTalleres;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Reactive;
use Livewire\Component;
use Livewire\WithPagination;

class Read extends Component
{
    use WithPagination;

    #[Reactive]
    public $id;

    public HorariosTalleres $horario;

    public array $alumnosSeleccionados = [];
    public bool $seleccionarTodos = false;

    public bool $showConfirmModal = false;
    public string $actionType = '';

    public $docente, $taller;

    public function mount(): void
    {
        // Usar el nombre de clase corregido
        $this->horario = HorariosTalleres::findOrFail($this->id);

        $this->docente = $this->horario->docente_id;
        $this->taller = $this->horario->taller_id;
    }

    //^==================================================================================================Ver alumnos

    public function getAlumnosProperty()
    {
        return HorariosAlumnos::query()
            ->where('horario_id', $this->id)
            ->with(['alumno.user'])
            ->addSelect([
                // LA CORRECCIÓN ESTÁ AQUÍ
                'credito_liberado' => CreditosAlumnos::select(DB::raw(1))
                    ->whereColumn('horarios_alumnos.alumno_id', 'creditos_alumnos.alumno_id')
                    ->where('horario_id', $this->id)
                    ->limit(1)
            ])
            ->paginate(10, ['*'], 'alumnosPage');
    }

    //^==================================================================================================Seleccionar todos los alummnos
    public function updatedSeleccionarTodos(bool $value): void
    {
        if ($value) {
            $this->alumnosSeleccionados = HorariosAlumnos::where('horario_id', $this->id)
                ->pluck('alumno_id')
                ->map(fn($id) => (string) $id)
                ->toArray();
        } else {
            $this->reset('alumnosSeleccionados');
        }
    }

    public function updatedAlumnosSeleccionados(): void
    {
        $totalAlumnos = HorariosAlumnos::where('horario_id', $this->id)->count();
        $this->seleccionarTodos = (count($this->alumnosSeleccionados) === $totalAlumnos && $totalAlumnos > 0);
    }

    //^==================================================================================================Confirmar creditos

    public function confirmarLiberarCreditos(string $type): void
    {
        $this->actionType = $type;
        $this->showConfirmModal = true;
    }

    public $password, $password_confirmation;

    public function liberarCreditos(): void
    {
        $this->validate([
            'password' => ['required', 'string', 'confirmed'],
        ]);

        if (!Hash::check($this->password, Auth::user()->password)) {
            $this->notifications('danger', 'Error', 'La contraseña no coincide.');
            return;
        }

        $alumnosIdsParaLiberar = [];
        if ($this->actionType === 'selected') {
            $alumnosIdsParaLiberar = HorariosAlumnos::whereIn('alumno_id', $this->alumnosSeleccionados)
                ->pluck('alumno_id')
                ->toArray();
        } elseif ($this->actionType === 'all') {
            $alumnosIdsParaLiberar = HorariosAlumnos::where('horario_id', $this->id)
                ->pluck('alumno_id')
                ->toArray();
        }

        if (empty($alumnosIdsParaLiberar)) {
            $this->notifications('danger', 'Error', 'No se seleccionó ningún alumno válido.');
            $this->closeModal();
            return;
        }

        try {
            DB::transaction(function () use ($alumnosIdsParaLiberar) {
                $alumnosConCreditoYaLiberado = CreditosAlumnos::where('horario_id', $this->id)
                    ->whereIn('alumno_id', $alumnosIdsParaLiberar)
                    ->pluck('alumno_id')
                    ->toArray();

                $alumnosParaProcesar = array_diff($alumnosIdsParaLiberar, $alumnosConCreditoYaLiberado);

                if (empty($alumnosParaProcesar)) {
                    $this->notifications('info', 'Información', 'Todos los alumnos seleccionados ya tenían su crédito liberado.');
                }

                $nuevosCreditos = [];
                foreach ($alumnosParaProcesar as $alumnoId) {
                    $nuevosCreditos[] = [
                        'alumno_id' => $alumnoId,
                        'horario_id' => $this->id,
                        'docente_id' => $this->docente,
                        'taller_id' => $this->taller,
                        'valor_numerico' => 1,
                        'valor_creditos' => 1,
                        'desempenio' => 'Bueno',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }

                CreditosAlumnos::insert($nuevosCreditos);

                DB::commit();
                $this->notifications('success', 'Éxito', '¡Se liberaron ' . count($nuevosCreditos) . ' créditos exitosamente!');
                $this->closeModal();
                $this->reser(['password', 'password_confirmation']);
            });
            $this->closeModal();
        } catch (\Exception $e) {
            DB::rollBack();
            //dd($e);
            $this->notifications('danger', 'Horario', 'Ocurrió un error al procesar la solicitud.');
        }
    }

    public function closeModal(): void
    {
        $this->showConfirmModal = false;
        $this->reset('alumnosSeleccionados', 'seleccionarTodos', 'actionType');
    }

    //*================================================================================================================================= Notification


    public function notifications($type, $title, $message)
    {
        //info-success-danger
        $this->dispatch('notify',  variant: $type, title: $title, message: $message);
    }


    public function render()
    {

        return view('livewire.modules.users.docentes.horarios.read', [
            'alumnos' => $this->alumnos, // Pasamos la propiedad computada a la vista
        ]);
    }
}
