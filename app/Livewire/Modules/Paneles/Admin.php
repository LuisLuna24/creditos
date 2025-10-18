<?php

namespace App\Livewire\Modules\Paneles;

use App\Models\horariosAlumnos;
use App\Models\horariosTalleres;
use App\Models\talleres;
use App\Models\User;
use Livewire\Component;

class Admin extends Component
{
    // Métricas para las tarjetas
    public $totalAlumnos;
    public $totalDocentes;
    public $totalTalleres;
    public $totalInscripciones;

    // Listas para el contenido principal
    public $talleresPopulares;
    public $alumnosRecientes;
    public $docentesRecientes;

    public function mount()
    {
        // Cargar las métricas principales
        // Asegúrate de ajustar los queries a tu estructura (ej. roles)
        $this->totalAlumnos = User::where('type_user_id', '3')->count();
        $this->totalDocentes = User::where('type_user_id', '2')->count();
        $this->totalTalleres = talleres::count();
        $this->totalInscripciones = horariosAlumnos::count();

        $this->talleresPopulares = horariosTalleres::with('taller')
            ->withCount('alumnos') // Asume una relación 'alumnos' en el modelo Horario
            ->orderBy('alumnos_count', 'desc')
            ->take(5)
            ->get();

        // Cargar los últimos usuarios registrados
        $this->alumnosRecientes = User::where('type_user_id', '3')->latest()->take(5)->get();
        $this->docentesRecientes = User::where('type_user_id', '2')->latest()->take(5)->get();
    }

    public function render()
    {
        return view('livewire.modules.paneles.admin');
    }
}
