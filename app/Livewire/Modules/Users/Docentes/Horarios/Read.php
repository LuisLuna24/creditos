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

    //^==================================================================================================Validacion de contraseña

    public function verifyUserPassword(string $passwordField = 'password'): bool
    {
        $this->validate([
            $passwordField => ['required', 'string'],
        ]);

        if (Hash::check($this->$passwordField, Auth::user()->password)) {
            return true; // La contraseña es correcta
        }

        $this->notifications('danger', 'Error', 'La contraseña no coincide.');
        $this->reset($passwordField);

        return false;
    }

    public function resetPassword()
    {
        $this->reset(['password', 'password_confirmation']);
        $this->resetErrorBag();
    }


    //^==================================================================================================Confirmar creditos

    public function confirmarLiberarCreditos(string $type): void
    {
        $this->resetPassword();
        $this->actionType = $type;
        $this->showConfirmModal = true;
    }

    public $password, $password_confirmation;

    public function liberarCreditos(): void
    {
        if (!$this->verifyUserPassword()) {
            return;
        }

        try {
            DB::transaction(function () {
                $alumnosConCreditoYaLiberado = CreditosAlumnos::where('horario_id', $this->id)
                    ->pluck('alumno_id');

                $query = HorariosAlumnos::where('horario_id', $this->id)
                    ->whereNotIn('alumno_id', $alumnosConCreditoYaLiberado);

                if ($this->actionType === 'selected') {
                    if (empty($this->alumnosSeleccionados)) {
                        $this->notifications('info', 'Información', 'No se ha seleccionado ningún alumno.');
                        return;
                    }
                    $query->whereIn('alumno_id', $this->alumnosSeleccionados);
                }

                $alumnosParaProcesar = $query->pluck('alumno_id')->toArray();

                if (empty($alumnosParaProcesar)) {
                    $this->notifications('info', 'Información', 'Todos los alumnos seleccionados ya tenían su crédito liberado o no hay alumnos por procesar.');
                    $this->closeModal();
                    return;
                }
                $nuevosCreditos = collect($alumnosParaProcesar)->map(function ($alumnoId) {
                    return [
                        'alumno_id'      => $alumnoId,
                        'horario_id'     => $this->id,
                        'docente_id'     => $this->docente,
                        'taller_id'      => $this->taller,
                        'valor_numerico' => 1,
                        'valor_creditos' => 1,
                        'desempenio'     => 'Bueno',
                        'created_at'     => now(),
                        'updated_at'     => now(),
                    ];
                })->all();

                CreditosAlumnos::insert($nuevosCreditos);

                DB::commit();
                $this->notifications('success', 'Éxito', '¡Se liberaron ' . count($nuevosCreditos) . ' créditos exitosamente!');
                $this->closeModal();
                $this->resetPassword();
            });
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
            $this->notifications('danger', 'Error', 'Ocurrió un error inesperado al procesar la solicitud.');
        }
    }

    public function closeModal(): void
    {
        $this->showConfirmModal = false;
        $this->reset('alumnosSeleccionados', 'seleccionarTodos', 'actionType');
    }

    //^==================================================================================================Eliminar alumnos


    public $deleteModalAlumno = false;
    public $deleteId;

    public function deleteAlumno($id)
    {
        $this->resetPassword();
        $this->deleteModalAlumno = true;
        $this->deleteId = $id;
    }

    public function deleteAlumnoSubmit()
    {
        if (!$this->verifyUserPassword()) {
            return;
        }

        try {
            DB::transaction(function () {
                $registro = HorariosAlumnos::findOrFail($this->deleteId);
                $registro->delete();
            });

            $this->notifications('success', 'Éxito', 'El alumno se dio de baja del horario exitosamente.');
            $this->deleteModalAlumno = false;
        } catch (\Exception $e) {
            report($e); // Buena práctica: registrar el error para futura depuración
            $this->notifications('danger', 'Error', 'Ocurrió un error inesperado al procesar la solicitud.');
        }
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
