<?php

namespace App\Livewire\Modules\Users\Docentes\Talleres;

use App\Livewire\Traits\WithNotifications;
use App\Models\horariosTalleres;
use App\Models\talleres;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

    //*================================================================================================================================= Desabilitar horarios

    public function desabilitarHorarios()
    {
        // Ejecuta una sola consulta de actualización masiva
        $filasAfectadas = horariosTalleres::whereHas('taller', function ($query) {
            $query->where('docente_id', Auth::user()->docente->docente_id);
        })
            ->where('estatus', 1)
            ->where('dia_fin', '<', now())
            ->update(['estatus' => 0]);
    }

    public function mount()
    {
        //$this->desabilitarHorarios();
    }

    //*================================================================================================================================= Editar

    public $modalForm = false;
    public $nombre = '';
    public $tipo = 'Deportivo';
    public $editId;

    protected $rules = [
        'nombre' => 'required|string|max:100',
        'tipo' => 'required|in:Academico,Cultural,Deportivo',
    ];

    public function edit($id)
    {
        $this->modalForm = true;
        $taller = talleres::findOrFail($id);

        $this->editId = $id;
        $this->nombre = $taller->nombre;
        $this->tipo = $taller->tipo;
    }


    public function submitForm()
    {
        $this->validate();

        DB::beginTransaction();
        try {
            talleres::find($this->editId)->update([
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
