<?php

namespace App\Livewire\Modules\Users\Alumnos\Talleres;

use App\Livewire\Traits\WithNotifications;
use App\Models\horariosAlumnos;
use App\Models\horariosTalleres;
use App\Models\talleres;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Create extends Component
{
    use WithPagination;
    use WithNotifications;
    public $search;

    public function mount()
    {
        $this->inscripciones();
    }

    public function info($id)
    {
        return redirect()->route('alumnos.horarios.read', $id);
    }

    public function inscripciones()
    {
        $alumnoId = Auth::user()->alumno->alumno_id;

        $inscripcionesActivas = horariosAlumnos::where('alumno_id', $alumnoId)
            ->where('estatus', '1')
            ->count();

        if ($inscripcionesActivas >= 2) {
            $this->notifications('danger', 'Mis talleres', 'Lo sentimos, ya estás inscrito en 2 talleres.');
            return redirect()->route('alumnos.talleres.index');
        }
    }

    //*================================================================================================================================= Notification

    public function notifications($type, $title, $message)
    {
        $this->dispatch('notify',  variant: $type, title: $title, message: $message);
        session()->flash('notify', [
            'variant' => $type,
            'title'   => $title,
            'message' => $message,
        ]);
    }

    public function render()
    {

        $alumnoId = Auth::user()->alumno->alumno_id;


        $horariosInscritosIds = horariosAlumnos::where('alumno_id', $alumnoId)
            ->where('estatus', '1')
            ->pluck('horario_id');


        $talleresInscritosIds = HorariosTalleres::whereIn('horario_id', $horariosInscritosIds)
            ->pluck('taller_id')
            ->unique()
            ->toArray();

        $talleres = Talleres::query()
            ->where('estatus', 1)
            ->where(function ($q) {
                $q->where('nombre', 'LIKE', '%' . $this->search . '%');
            })
            ->whereNotIn('taller_id', $talleresInscritosIds)
            ->orderBy('nombre', 'asc')
            ->paginate(10, ['*'], 'talleres-page');

        return view('livewire.modules.users.alumnos.talleres.create', [
            'talleres' => $talleres
        ]);
    }
}
