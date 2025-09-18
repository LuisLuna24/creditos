<?php

namespace App\Livewire\Modules\Users\Admin\Catalogos;

use App\Models\diasSemana as ModelsDiasSemana;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;

class DiasSemana extends Component
{
    use WithPagination;
    public $perEstatus, $perPage = '10', $search;

    //*================================================================================================================================= Form
    public $modalForm = false;
    public $typeForm;
    public function create()
    {
        $this->resetForm();
        $this->modalForm = true;
        $this->typeForm = 1;
    }

    public function edit($id)
    {
        $this->resetForm();
        $this->modalForm = true;
        $this->typeForm = 2;
    }

    public function submitForms()
    {
        DB::beginTransaction();
        try {


            DB::commit();
            $this->closeModal();
            $this->resetForm();
            $this->notifications('success', 'Dias de la Semana', '');
        } catch (\Exception $e) {
            DB::rollBack();
            //dd($e->getMessage());
            $this->notifications('danger', 'Dias de la Semana', 'Lo sentimos, que ha ocurrido un error. Si el problema persiste, contacte al área de sistemas');
        }
    }

    public function resetForm()
    {
        $this->reset([
            'typeForm'
        ]);
       $this->resetErrorBag();
    }

    public function closeModal(){
        $this->modalForm = false;
    }

    //*================================================================================================================================= Estatus

    public $estatusModal = false;
    public $statusId,$status;

    public function statusRegister($id)
    {
        $this->estatusModal = true;
        $data = ModelsDiasSemana::find($id);
        $this->statusId = $id;
        $this->status = $data->estatus;
    }

    public function estatusSubmit()
    {
        DB::beginTransaction();
        try {
            $data = ModelsDiasSemana::find($this->statusId);

            $data->update([
                'estatus' => $this->status == 1 ? 0 : 1
            ]);

            DB::commit();
            $this->estatusModal = false;
            $this->reset(['statusId']);
            $this->notifications('success', 'Dias de la Semana', 'El estatus cambio con exitio');
        } catch (\Exception $e) {
            DB::rollBack();
            //dd($e->getMessage());
            $this->notifications('danger', 'Dias de la Semana', 'Lo sentimos, que ha ocurrido un error. Si el problema persiste, contacte al área de sistemas');
        }
    }

    //*================================================================================================================================= Eliminar
    public $deleteModal = false;
    public $delteId;
    public function delete($id)
    {
        $this->deleteModal = true;
        $this->delteId = $id;
    }

    public $password, $password_confirmation;
    public function deleteSubmit()
    {
        $this->validate([
            'password' => 'required|string|confirmed',
        ]);

        if (!Hash::check($this->password, hashedValue: Auth::user()->password)) {
            $this->notifications('danger', 'Dias de la Semana', 'La contraseña no coincide con la actual.');
            return;
        }

        DB::beginTransaction();
        try {
            ModelsDiasSemana::find($this->delteId)->delete();

            DB::commit();
            $this->deleteModal = false;
            $this->reset(['delteId']);
            $this->notifications('danger', 'Dias de la Semana', 'El dia ha sido eliminado junto a sus registros');
        } catch (\Exception $e) {
            DB::rollBack();
            //dd($e->getMessage());
            $this->notifications('danger', 'Dias de la Semana', 'Lo sentimos, que ha ocurrido un error. Si el problema persiste, contacte al área de sistemas');
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
        $collection = ModelsDiasSemana::query();


        if ($this->perEstatus) {
            switch ($this->perEstatus) {
                case '1':
                    $collection = $collection->where('estatus', '1');
                    break;
                case '2':
                    $collection = $collection->where('estatus', '0');
                    break;
            }
        }

        $collection = $collection->where(function ($query) {
            $query->where('nombre', 'like', '%' . $this->search . '%');
        });

        $collection = $collection->orderBy('created_at', 'desc')->paginate($this->perPage, pageName: "collection-page");
        return view('livewire.modules.users.admin.catalogos.dias-semana', [
            'collection' => $collection
        ]);
    }
}
