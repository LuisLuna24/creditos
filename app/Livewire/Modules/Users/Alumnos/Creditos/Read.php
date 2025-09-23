<?php

namespace App\Livewire\Modules\Users\Alumnos\Creditos;

use App\Livewire\Forms\Share\Talleres\horarioForm;
use App\Livewire\Traits\WithNotifications;
use App\Models\creditosAlumnos;
use App\Models\horariosAlumnos;
use App\Models\horariosTalleres;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class Read extends Component
{
    use WithNotifications;

    #[Reactive]
    public $id;

    public horarioForm $horarioForm;

    public $hoarioId;

    public function mount()
    {
        $this->horarioForm->searchDias();

        $this->hoarioId = creditosAlumnos::find($this->id);

        $this->horarioForm->searchData($this->hoarioId->credito_id );
        $this->searchData();
    }

    public $nombre, $docente, $alumno, $valor_numerico, $numero_creditos,$desempenio;
    public function searchData()
    {
        $data = horariosTalleres::find($this->hoarioId->credito_id);

        $this->nombre = $data->taller->nombre;
        $this->docente = $data->taller->docente->user->name;
        $this->alumno = Auth::user()->alumno->user->name;
        $this->valor_numerico = $this->hoarioId->valor_numerico;
        $this->numero_creditos = $this->hoarioId->valor_creditos;
        $this->desempenio = $this->hoarioId->desempenio;
    }

    public function render()
    {
        return view('livewire.modules.users.alumnos.creditos.read');
    }
}
