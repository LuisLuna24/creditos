<?php

namespace App\Livewire\Modules\Users\Docentes\Talleres;

use App\Livewire\Traits\WithNotifications;
use App\Models\talleres;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    use WithNotifications;

    public $perEstatus, $perPage = '10', $search;

    public function create()
    {
        return redirect()->route('docentes.talleres.create');
    }

    public function info($id)
    {
        return redirect()->route('docentes.talleres.edit', ['id' => $id]);
    }


    //*================================================================================================================================= Notification

    public function notifications($type, $title, $message)
    {
        //info-success-danger
        $this->dispatch('notify',  variant: $type, title: $title, message: $message);
    }

    public function render()
    {
        $collection = talleres::query();

        $collection = $collection->where('docente_id', Auth::user()->docente->docente_id);

        $collection = $collection->where('estatus', '1');

        $collection = $collection->orderBy('created_at', 'desc')->paginate($this->perPage, pageName: "collection-page");

        return view('livewire.modules.users.docentes.talleres.index', [
            'collection' => $collection
        ]);
    }
}
