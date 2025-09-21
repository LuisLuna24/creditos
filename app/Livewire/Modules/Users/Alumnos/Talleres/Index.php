<?php

namespace App\Livewire\Modules\Users\Alumnos\Talleres;

use App\Livewire\Traits\WithNotifications;
use App\Models\horariosAlumnos;
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
        $count = horariosAlumnos::where('alumno_id', Auth::user()->alumno->alumno_id)
            ->where('estatus', '1')
            ->count();
        if ($count < 2) {
            return redirect()->route('alumnos.talleres.create');
        } else {
            $this->notifications('danger', 'Mis talleres', 'Lo sentimos, ya estás inscrito en 2 talleres.');
            return redirect()->back();
        }
    }

    public function info($id)
    {
        return redirect()->route('alumnos.talleres.read', ['id' => $id]);
    }


    //*================================================================================================================================= Notification

    public function notifications($type, $title, $message)
    {
        //info-success-danger
        $this->dispatch('notify',  variant: $type, title: $title, message: $message);
    }

    public function render()
    {
        $collection = horariosAlumnos::query();

        $collection = $collection->where('alumno_id', Auth::user()->alumno->alumno_id);

        $collection = $collection->where('estatus', '1');

        $collection = $collection->orderBy('created_at', 'desc')->paginate($this->perPage, pageName: "collection-page");

        return view('livewire.modules.users.alumnos.talleres.index', [
            'collection' => $collection
        ]);
    }
}
