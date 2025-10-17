<?php

namespace App\Livewire\Modules\Users\Docentes\Talleres;

use App\Models\talleres;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class Edit extends Component
{

    #[Reactive]
    public $id;

    public function mount()
    {
        $taller = talleres::find($this->id);

        $this->nombre = $taller->nombre;
        $this->tipo = $taller->tipo;
    }

    public $nombre = '';
    public $tipo = 'Deportivo';

    protected $rules = [
        'nombre' => 'required|string|max:100',
        'tipo' => 'required|in:Academico,Cultural,Deportivo',
    ];

    public function saveTaller()
    {
        $this->validate();

        DB::beginTransaction();
        try {
            talleres::find($this->id)->update([
                'nombre' => $this->nombre,
                'tipo' => $this->tipo,
            ]);

            DB::commit();
            $this->notifications('success', 'Talleres', 'El taller se ha actualizado con éxito.');
            $this->reset();
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            $this->notifications('danger', 'Error', 'Ocurrió un error al guardar. Por favor, inténtalo de nuevo.');
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
        return view('livewire.modules.users.docentes.talleres.edit');
    }
}
