<?php

namespace App\Livewire\Modules\Users\Admin\Docente;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{

    use WithPagination;
    public $perEstatus, $perPage = '10', $search;

    public function create(){
        return redirect()->route('admin.usuarios.docentes.create');
    }

    public function edit($id){
        return redirect()->route('admin.usuarios.docentes.edit', [$id]);
    }

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

        if (!Hash::check($this->password, Auth::user()->password)) {
            $this->notifications('danger', 'Docentes', 'La contraseña no coincide con la actual.');
            return;
        }

        DB::beginTransaction();
        try {
            User::find($this->delteId)->delete();

            DB::commit();
            $this->deleteModal = false;
            $this->reset(['delteId']);
            $this->notifications('danger', 'Docentes', 'El docente ha sido eliminado junto a sus registros');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            $this->notifications('danger', 'Docentes', 'Lo sentimos, que ha ocurrido un error. Si el problema persiste, contacte al área de sistemas');
        }
    }

    //*================================================================================================================================= Estatus

    public $estatusModal = false;
    public $statusId,$status;

    public function statusRegister($id)
    {
        $this->estatusModal = true;
        $data = User::find($id);
        $this->statusId = $id;
        $this->status = $data->estatus;
    }

    public function estatusSubmit()
    {
        DB::beginTransaction();
        try {
            $data = User::find($this->statusId);

            $data->update([
                'estatus' => $this->status == 1 ? 0 : 1
            ]);

            DB::commit();
            $this->estatusModal = false;
            $this->reset(['statusId']);
            $this->notifications('success', 'Docente', 'El estatus cambio con exitio');
        } catch (\Exception $e) {
            DB::rollBack();
            //dd($e->getMessage());
            $this->notifications('danger', 'Docente', 'Lo sentimos, que ha ocurrido un error. Si el problema persiste, contacte al área de sistemas');
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
        $collection = User::query();

        $collection = $collection->where('type_user_id', 2);

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
            $query->where('name', 'like', '%' . $this->search . '%');
        });

        $collection = $collection->orderBy('created_at', 'desc')->paginate($this->perPage, pageName: "collection-page");
        return view('livewire.modules.users.admin.docente.index',[
            'collection'=> $collection,
        ]);
    }
}
