<?php

namespace App\Livewire\Modules\Users\Admin\Catalogos\Talleres;

use App\Livewire\Forms\Share\Talleres\horarioForm;
use App\Models\horariosAlumnos;
use App\Models\horariosTalleres;
use App\Models\talleres;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Reactive;
use Livewire\Component;
use Livewire\WithPagination;

class Read extends Component
{

    use WithPagination;

    public horarioForm $horarioForm;
    public $perEstatus = 1;

    //*================================================================================================================================= Buscar Taller

    #[Reactive]
    public $id;

    public function mount()
    {
        $this->searchData();
        $this->horarioForm->searchDias();
    }

    public string $nombre;
    public string $docente;
    public function searchData()
    {
        $data = talleres::find($this->id);
        $this->nombre = $data->nombre;
        $this->docente = $data->docente->user->name;
        $this->docenteId = $data->docente->docente_id;
    }
    //*================================================================================================================================= Form
    public $modalForm = false;
    public $typeForm, $editId, $docenteId;
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
        $this->editId = $id;
        $this->typeForm = 2;
        $this->horarioForm->searchData($id);
    }

    public function submitForm()
    {
        $this->horarioForm->validateForm();

        DB::beginTransaction();
        try {

            $this->horarioForm->save($this->id, $this->docenteId, $this->editId);

            if ($this->typeForm == 1) {
                $message = 'Se ha agregado el horario con exito';
            } else {
                $message = 'Se ha editado el horario con exito';
            }

            DB::commit();
            $this->closeModal();
            $this->resetForm();
            $this->notifications('success', 'Talleres', $message);
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            $this->notifications('danger', 'Talleres', 'Lo sentimos, que ha ocurrido un error. Si el problema persiste, contacte al área de sistemas');
        }
    }

    public function resetForm()
    {
        $this->reset([
            'typeForm',
            'editId'
        ]);
        $this->resetErrorBag();
        $this->horarioForm->resetForm();
    }

    public function closeModal()
    {
        $this->modalForm = false;
    }

    //*================================================================================================================================= Estatus

    public $estatusModal = false;
    public $statusId, $status;

    public function statusRegister($id)
    {
        $this->estatusModal = true;
        $data = horariosTalleres::find($id);
        $this->statusId = $id;
        $this->status = $data->estatus;
    }

    public function estatusSubmit()
    {
        DB::beginTransaction();
        try {
            $data = horariosTalleres::find($this->statusId);

            $data->update([
                'estatus' => $this->status == 1 ? 0 : 1
            ]);

            DB::commit();
            $this->estatusModal = false;
            $this->reset(['statusId']);
            $this->notifications('success', 'Talleres', 'El estatus cambio con exitio');
        } catch (\Exception $e) {
            DB::rollBack();
            //dd($e->getMessage());
            $this->notifications('danger', 'Talleres', 'Lo sentimos, que ha ocurrido un error. Si el problema persiste, contacte al área de sistemas');
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
            $this->notifications('danger', 'Talleres', 'La contraseña no coincide con la actual.');
            return;
        }

        DB::beginTransaction();
        try {
            horariosTalleres::find($this->delteId)->delete();

            DB::commit();
            $this->deleteModal = false;
            $this->reset(['delteId']);
            $this->notifications('danger', 'Talleres', 'El horario ha sido eliminado junto a sus registros');
        } catch (\Exception $e) {
            DB::rollBack();
            //dd($e->getMessage());
            $this->notifications('danger', 'Talleres', 'Lo sentimos, que ha ocurrido un error. Si el problema persiste, contacte al área de sistemas');
        }
    }

    //*================================================================================================================================= Ver alumnos

    public $modalView = false;
    public $vieId;

    public function view($id){
        $this->modalView = true;
        $this->vieId = $id;
    }

    public function closeView(){
        $this->modalView = false;
        $this->reset([
            'vieId'
        ]);
    }

    //*================================================================================================================================= Notification

    public function notifications($type, $title, $message)
    {
        //info-success-danger
        $this->dispatch('notify',  variant: $type, title: $title, message: $message);
    }


    //*================================================================================================================================= Render
    public function render()
    {
        $horarios = horariosTalleres::query();

        $horarios = $horarios->where('taller_id', $this->id);

        if ($this->perEstatus) {
            switch ($this->perEstatus) {
                case '1':
                    $horarios = $horarios->where('estatus', '1');
                    break;
                case '2':
                    $horarios = $horarios->where('estatus', '0');
                    break;
            }
        }

        $alumnos = horariosAlumnos::query();

        if ($this->vieId) {
            $alumnos = $alumnos->where('horario_alumno_id', $this->vieId);
        }

        $alumnos = $alumnos->orderBy('alumno_id', 'asc')->paginate('10', pageName: 'alumnos-page');

        $horarios = $horarios->orderBy('created_at', 'desc')->paginate(10, pageName: 'horarios-page');

        return view('livewire.modules.users.admin.catalogos.talleres.read', [
            'horarios' => $horarios,
            'alumnos' => $alumnos
        ]);
    }
}
