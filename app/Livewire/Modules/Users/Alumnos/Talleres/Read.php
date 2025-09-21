<?php

namespace App\Livewire\Modules\Users\Alumnos\Talleres;

use App\Livewire\Forms\Share\Talleres\horarioForm;
use App\Livewire\Traits\WithNotifications;
use App\Models\horariosAlumnos;
use App\Models\horariosTalleres;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class Read extends Component
{
    use WithNotifications;

    #[Reactive]
    public $id;

    public horarioForm $horarioForm;

    public $hoarioId;

    public function mount()
    {
        $this->horarioForm->searchDias();

        $this->hoarioId = horariosAlumnos::find($this->id)->horario_id;

        $this->horarioForm->searchData($this->hoarioId);
        $this->searchData();
    }

    public $nombre, $docente;
    public function searchData()
    {
        $data = horariosTalleres::find($this->hoarioId);

        $this->nombre = $data->taller->nombre;
        $this->docente = $data->taller->docente->user->name;
    }

    //*================================================================================================================================= Delete taller

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
            $horario = horariosAlumnos::find($this->delteId);
            $horario->delete();

            DB::commit();
            $this->deleteModal = false;
            $this->reset(['delteId']);
            $this->notifications('danger', 'Talleres', 'Te has dado de baja del taller.');
            return redirect()->route('alumnos.talleres.index');
        } catch (\Exception $e) {
            DB::rollBack();
            //dd($e->getMessage());
            $this->notifications('danger', 'Talleres', 'Lo sentimos, que ha ocurrido un error. Si el problema persiste, contacte al área de sistemas');
        }
    }


    //*================================================================================================================================= Notification

    public function notifications($type, $title, $message)
    {
        $this->dispatch('notify',  variant: $type, title: $title, message: $message);
    }

    public function render()
    {
        return view('livewire.modules.users.alumnos.talleres.read');
    }
}
