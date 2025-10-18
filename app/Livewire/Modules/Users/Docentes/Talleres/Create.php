<?php

namespace App\Livewire\Modules\Users\Docentes\Talleres;

use App\Models\talleres;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Create extends Component
{

    public $nombre = '';
    public $tipo = 'Deportivo';

    public function saveTaller()
    {
        $this->validate([
            'nombre' => [
                'required',
                'max:100',
                Rule::unique('talleres', 'nombre')
                    ->ignore($this->editId, 'taller_id')
            ],
            'tipo' => 'required|in:Academico,Cultural,Deportivo',
        ]);

        DB::beginTransaction();
        try {
            talleres::create([
                'docente_id' => Auth::user()->docente->docente_id,
                'nombre' => $this->nombre,
                'tipo' => $this->tipo,
            ]);

            DB::commit();
            $this->notifications('success', 'Talleres', 'El taller se a agregado con exito.');
            $this->reset();
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
            $this->notifications('danger', 'Talleres', 'Lo sentimos, que ha ocurrido un error. Si el problema persiste, contacte al área de sistemas');
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
        return view('livewire.modules.users.docentes.talleres.create');
    }
}
