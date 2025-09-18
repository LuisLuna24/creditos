<?php

namespace App\Livewire\Modules\Users\Admin\Catalogos\Talleres;

use App\Models\talleres;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class Read extends Component
{

    #[Reactive]
    public $id;

    public function mount()
    {
        $this->searchData();
    }

    public string $nombre;
    public string $docente;
    public $horarios = [];
    public function searchData()
    {
        $data = talleres::find($this->id);
        $this->nombre = $data->nombre;
        $this->docente = $data->docente->user->name;
        $this->horarios = $data->horarios;
    }

    public function render()
    {
        return view('livewire.modules.users.admin.catalogos.talleres.read');
    }
}
