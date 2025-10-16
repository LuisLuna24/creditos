<?php

namespace App\Livewire\Modules\Users\Docentes\Talleres;

use App\Models\talleres;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Create extends Component
{

    public $nombre = '';
    public $tipo = 'Deportivo';

    protected $rules = [
        'nombre' => 'required|string|max:100',
        'tipo' => 'required|in:Académico,Cultural,Deportivo',
    ];

    public function saveTaller()
    {
        $this->validate();

        DB::beginTransaction();
        try {
            talleres::create([
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
