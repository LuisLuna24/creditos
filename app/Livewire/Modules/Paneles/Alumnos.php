<?php

namespace App\Livewire\Modules\Paneles;

use App\Models\alumnos as ModelsAlumnos;
use App\Models\horariosAlumnos;
use App\Models\horariosTalleres;
use App\Models\talleres;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Alumnos extends Component
{

    use WithPagination;

    public function mount()
    {
        $this->searchData();
    }

    public $alumno_nombre, $alumno_creditos;
    public function searchData()
    {
        $data = Auth::user();

        $this->alumno_nombre = $data->name;
        $this->alumno_creditos = $data->alumno->creditos->count();
    }

    public function info($id)
    {
        return redirect()->route('alumnos.horarios.read', $id);
    }

    public function render()
    {
        $alumnoId = Auth::user()->alumno->alumno_id;


        $horariosInscritosIds = horariosAlumnos::where('alumno_id', $alumnoId)
            ->where('estatus', '1')
            ->pluck('horario_id');


        $talleresInscritosIds = horariosTalleres::whereIn('horario_id', $horariosInscritosIds)
            ->pluck('taller_id')
            ->unique()
            ->toArray();

        $talleres_disponibles = talleres::query()
            ->where('estatus', 1)
            ->whereNotIn('taller_id', $talleresInscritosIds)
            ->orderBy('nombre', 'asc')
            ->paginate(10, ['*'], 'talleres-page');

        $mis_inscripciones = horariosAlumnos::query();

        $mis_inscripciones = $mis_inscripciones->where('alumno_id', Auth::user()->alumno->alumno_id);

        $mis_inscripciones = $mis_inscripciones->where('estatus', '1');

        $mis_inscripciones = $mis_inscripciones->orderBy('created_at', 'desc')->paginate(10, pageName: "mis_inscripciones-page");

        return view('livewire.modules.paneles.alumnos', [
            'talleres_disponibles' => $talleres_disponibles,
            'mis_inscripciones' => $mis_inscripciones,
        ]);
    }
}
