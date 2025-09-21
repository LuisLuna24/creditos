<?php

namespace App\Livewire\Modules\Users\Alumnos\Horarios;

use App\Livewire\Traits\WithNotifications;
use App\Models\diasHorarios;
use App\Models\horariosAlumnos;
use App\Models\horariosTalleres;
use App\Models\talleres;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Reactive;
use Livewire\Component;
use Livewire\WithPagination;

class Read extends Component
{

    use WithNotifications;
    use WithPagination;

    #[Reactive]
    public $id;

    public function mount()
    {
        $this->inscripciones();
        $this->searchData();
    }

    public string $nombre;
    public string $docente;
    public function searchData()
    {
        $data = talleres::find($this->id);
        $this->nombre = $data->nombre;
        $this->docente = $data->docente->user->name;
    }

    public function inscripciones()
    {
        $alumnoId = Auth::user()->alumno->alumno_id;

        $inscripcionesActivas = horariosAlumnos::where('alumno_id', $alumnoId)
            ->where('estatus', '1')
            ->count();

        if ($inscripcionesActivas >= 2) {

            $this->notifications('warning', 'Talleres', 'Lo sentimos, ya estás inscrito en el máximo de talleres.');

            return redirect()->route('alumnos.talleres.index');
        }
    }

    //*================================================================================================================================= Inscribir

    public $inscribirModal = false;
    public $inscribirId;
    public function inscribir($id)
    {
        $this->inscribirModal = true;
        $this->inscribirId = $id;
    }

    public function inscribirForm()
    {
        $alumnoId = Auth::user()->alumno->alumno_id;

        $horariosInscritosIds = horariosAlumnos::where('alumno_id', $alumnoId)
            ->where('estatus', '1')
            ->pluck('horario_id');

        $talleresInscritosIds = HorariosTalleres::whereIn('horario_id', $horariosInscritosIds)
            ->pluck('taller_id')
            ->unique()
            ->toArray();

        if (in_array($this->id, $talleresInscritosIds)) {
            $this->notifications('warning', 'Talleres', 'Lo sentimos, ya estas inscrito a este taller. Escoje otro taller diferente');
            return;
        }

        DB::beginTransaction();
        try {
            horariosAlumnos::create([
                'alumno_id' => Auth::user()->alumno->alumno_id,
                'horario_id' => $this->inscribirId
            ]);

            $message = "Te has inscrito correctamente al taller de " . $this->nombre;
            DB::commit();
            $this->notifications('success', 'Talleres', $message);
            return redirect()->route('alumnos.talleres.index');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            $this->notifications('danger', 'Talleres', 'Lo sentimos, que ha ocurrido un error. Si el problema persiste, contacte al área de sistemas');
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

        $alumnoId = Auth::user()->alumno->alumno_id;

        $horariosInscritosIds = HorariosAlumnos::where('alumno_id', $alumnoId)
            ->where('estatus', '1')
            ->pluck('horario_id');

        $franjasInscritas = DiasHorarios::with('horario')
            ->whereIn('horario_id', $horariosInscritosIds)
            ->get();


        $horariosConflictivosIds = [];

        if ($franjasInscritas->isNotEmpty()) {

            $horariosConflictivosIds = HorariosTalleres::where('taller_id', $this->id)
                ->where(function ($query) use ($franjasInscritas) {
                    foreach ($franjasInscritas as $franja) {
                        $query->orWhere(function ($subQuery) use ($franja) {
                            $subQuery->whereHas('dias', function ($q) use ($franja) {
                                $q->where('dias_horarios.dia_id', $franja->dia_id);
                            });

                            $subQuery->where('hora_inicio', '<', $franja->horario->hora_fin)
                                ->where('hora_fin', '>', $franja->horario->hora_inicio);
                        });
                    }
                })
                ->pluck('horario_id');
        }

        $horarios = HorariosTalleres::query()
            ->where('taller_id', $this->id)
            ->where('estatus', '1')
            ->whereNotIn('horario_id', $horariosConflictivosIds)
            ->orderBy('created_at', 'desc')
            ->paginate(10, pageName: 'horarios-page');

        return view('livewire.modules.users.alumnos.horarios.read', [
            'horarios' => $horarios
        ]);
    }
}
