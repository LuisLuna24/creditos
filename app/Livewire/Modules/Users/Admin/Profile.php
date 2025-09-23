<?php

namespace App\Livewire\Modules\Users\Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Profile extends Component
{

    public $carreras = [];

    public function mount()
    {
        $this->searchData();
    }

    public $nombre, $correo, $carrera;

    public function searchData()
    {
        $data = Auth::user();
        $this->nombre = $data->name;
        $this->correo = $data->email;
        $this->name = $data->name;
        $this->email = $data->email;
    }

    public $name, $email;
    public function submitDataForm()
    {
        $this->validate([
            'name' => ['required', 'max:255'],
            'email' => ['required', 'max:255', 'email'],
        ]);

        DB::beginTransaction();
        try {

            Auth::user()->update([
                'name' => $this->name,
                'email' => $this->email,
            ]);

            DB::commit();
            $this->notifications('success', 'Perfil', 'Se ha actualizado con éxito la información de tu perfil.');
            $this->searchData();
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            $this->notifications('danger', 'Perfil', 'Lo sentimos, que ha ocurrido un error. Si el problema persiste, contacte al área de sistemas.');
        }
    }

    //*================================================================================================================================= actualizar contrsaena

    public $current_password, $password, $password_confirmation;
    public function submitPaswordChange()
    {
        $this->validate([
            'current_password' => 'required|string',
            'password' => 'required|string|confirmed',
        ]);

        if (!Hash::check($this->current_password, hashedValue: Auth::user()->password)) {
            $this->notifications('danger', 'Perfil', 'La contraseña no coincide con la actual.');
            return;
        }

        DB::beginTransaction();
        try {

            $data = Auth::user()->update([
                'password' => $this->password
            ]);

            DB::commit();
            $this->notifications('success', 'Perfil', 'Contraseña actualizada correctamente.');
            $this->reset(['current_password', 'password', 'password_confirmation']);
        } catch (\Exception $e) {
            DB::rollBack();
            //dd($e->getMessage());
            $this->notifications('danger', 'Carreas', 'Lo sentimos, que ha ocurrido un error. Si el problema persiste, contacte al área de sistemas');
        }
    }

    //*================================================================================================================================= Notification

    public function notifications($type, $title, $message)
    {
        $this->dispatch('notify',  variant: $type, title: $title, message: $message);
    }

    public function render()
    {
        return view('livewire.modules.users.admin.profile');
    }
}
