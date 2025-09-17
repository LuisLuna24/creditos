<?php

namespace App\Livewire\Forms\Share\Users;

use App\Models\alumnos;
use App\Models\docentes;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class dataForm extends Form
{
    public $matricula, $nombre, $a_paterno, $a_materno, $sexo = "M", $carrera = '';

    public function validateFormAlumnos()
    {
        $this->validate([
            'matricula' => ['required', 'numeric', Rule::unique('alumnos', 'alumno_id')->ignore($this->alumnoId,'alumno_id')],
            'nombre' => ['required', 'string', 'max:100'],
            'a_paterno' => ['required', 'string', 'max:100'],
            'a_materno' => ['required', 'string', 'max:100'],
            'sexo' => ['required'],
            'carrera' => ['required'],
        ]);
    }

    public function validateFormDocentes()
    {
        $this->validate([
            'matricula' => ['required', 'numeric', Rule::unique('docentes', 'docente_id')->ignore($this->docenteId,'docente_id')],
            'nombre' => ['required', 'string', 'max:100'],
            'a_paterno' => ['required', 'string', 'max:100'],
            'a_materno' => ['required', 'string', 'max:100'],
            'sexo' => ['required'],
        ]);
    }

    public function resetData()
    {
        $this->reset([
            'matricula',
            'nombre',
            'a_paterno',
            'a_materno',
            'sexo',
            'carrera',
        ]);
    }

    public function createAlumno($userId,)
    {

        $data = alumnos::create([
            'alumno_id' => $this->matricula,
            'user_id' => $userId,
            'carrera_id' => $this->carrera,
            'nombre' => $this->nombre,
            'a_paterno' => $this->a_paterno,
            'a_materno' => $this->a_materno,
            'sexo' => $this->sexo
        ]);

        User::find($userId)->update([
            'name' => $this->nombre . ' ' . $this->a_paterno . ' ' . $this->a_materno,
            'type_user_id' => 3
        ]);
    }

    public function createDocente($userId)
    {
        $data = docentes::create([
            'alumno_id' => $this->matricula,
            'user_id' => $userId,
            'nombre' => $this->nombre,
            'a_paterno' => $this->a_paterno,
            'a_materno' => $this->a_materno,
            'sexo' => $this->sexo
        ]);

        User::find($userId)->update([
            'name' => $this->nombre . ' ' . $this->a_paterno . ' ' . $this->a_materno,
            'type_user_id' => 2
        ]);
    }

    public $alumnoId;

    public function searchAlumno($id)
    {
        $data = alumnos::where('user_id', $id)->first();
        $this->alumnoId = $data->alumno_id;
        $this->matricula = $data->alumno_id;
        $this->carrera = $data->carrera;
        $this->nombre = $data->nombre;
        $this->a_paterno = $data->a_paterno;
        $this->a_materno = $data->a_materno;
        $this->sexo = $data->sexo;
    }

    public function editAlumno()
    {

        $data = alumnos::find($this->alumnoId);

        $data->update([
            'carrera_id ' => $this->carrera,
            'nombre' => $this->nombre,
            'a_paterno' => $this->a_paterno,
            'a_materno' => $this->a_materno,
            'sexo' => $this->sexo
        ]);

        User::find($data->user_id)->update([
            'name' => $this->nombre . ' ' . $this->a_paterno . ' ' . $this->a_materno,
            'type_user_id' => 3
        ]);
    }

    public $docenteId;

    public function searchDocente($id)
    {
        $data = docentes::where('user_id', $id)->first();
        $this->docenteId = $data->docente_id;
        $this->matricula = $data->docente_id;
        $this->nombre = $data->nombre;
        $this->a_paterno = $data->a_paterno;
        $this->a_materno = $data->a_materno;
        $this->sexo = $data->sexo;
    }

    public function editDocente()
    {

        $data = docentes::find($this->docenteId);

        $data->update([
            'docente_id' => $this->matricula,
            'nombre' => $this->nombre,
            'a_paterno' => $this->a_paterno,
            'a_materno' => $this->a_materno,
            'sexo' => $this->sexo
        ]);

        User::find($data->user_id)->update([
            'name' => $this->nombre . ' ' . $this->a_paterno . ' ' . $this->a_materno,
            'type_user_id' => 2
        ]);
    }
}
