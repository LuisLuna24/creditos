<?php

namespace App\Livewire\Modules\Paneles;

use App\Models\horariosTalleres;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Docente extends Component
{
    public $horariosDelDia;
    public $fechaActual;

    public function mount()
    {
        // Establecemos la fecha actual al cargar el componente
        $this->fechaActual = Carbon::now()->locale('es');
        $this->cargarHorarios();
    }

    public function cargarHorarios()
    {
        $docenteId = Auth::user()->docente->docente_id; // Reemplaza con Auth::id() cuando tengas la autenticación lista
        $hoy = Carbon::now();
        $diaDeLaSemanaId = $hoy->dayOfWeekIso; // Lunes=1, Martes=2 ... Domingo=7

        $this->horariosDelDia = horariosTalleres::with('taller')
            ->where('docente_id', $docenteId)
            ->where('dia_inicio', '<=', $hoy->toDateString())
            ->where('dia_fin', '>=', $hoy->toDateString())
            ->whereHas('dias', function ($query) use ($diaDeLaSemanaId) {
                // 👇 ¡AQUÍ ESTÁ LA CORRECCIÓN!
                $query->where('dias_semanas.dia_id', $diaDeLaSemanaId);
            })
            ->orderBy('hora_inicio')
            ->get();
    }

    public function render()
    {
        return view('livewire.modules.paneles.docente');
    }
}
