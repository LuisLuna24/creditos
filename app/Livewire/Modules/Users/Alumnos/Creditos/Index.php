<?php

namespace App\Livewire\Modules\Users\Alumnos\Creditos;

use App\Models\creditosAlumnos;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $perEstatus, $perPage = '10', $search;

    public function info($id)
    {
        return redirect()->route('alumnos.creditos.read', $id);
    }

    public function render()
    {
        $collection = creditosAlumnos::query();

        $collection = $collection->where('alumno_id', Auth::user()->alumno->alumno_id);

        $collection = $collection->where('estatus', '1');

        $collection = $collection->orderBy('created_at', 'desc')->paginate($this->perPage, pageName: "collection-page");

        return view('livewire.modules.users.alumnos.creditos.index', [
            'collection' => $collection
        ]);
    }
}
