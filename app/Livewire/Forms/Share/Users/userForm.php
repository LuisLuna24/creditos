<?php

namespace App\Livewire\Forms\Share\Users;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class userForm extends Form
{
    public $userId;
    public $nombre, $email, $password, $password_confirmation;

    public function validateUser()
    {
        $this->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'email'  => ['required', 'email', Rule::unique('users', 'email')->ignore($this->userId)],
            'password' => ['nullable', 'min:8', 'confirmed'],
        ]);
    }

    public function searchUser($id){
        $data = User::find($id);
        $this->userId = $data->id;
        $this->nombre = $data->name;
        $this->email = $data->email;
    }

    public function resetUser(){
        $this->reset([
            'nombre',
            'userId',
            'email',
            'password',
            'password_confirmation',
        ]);
    }

    public function createUser()
    {
        $data = User::create([
            'name' => $this->nombre,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        $this->userId = $data->id;
    }

    public function editUser(){

    }
}
