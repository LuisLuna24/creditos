<?php

namespace App\Livewire\Modules\Users\Alumnos;

use App\Models\alumnos;
use App\Models\carreras;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CompleteProfile extends Component
{
    public $carrera_id = '';
    public $nombre = '';
    public $a_paterno = '';
    public $a_materno = '';
    public $sexo = 'M';
    public $semestre = 1;
    public $matricula = '';

    public $carreras = [];

    public function mount()
    {
        if (Auth::user()->alumno) {
            return redirect()->route('alumnos.panel');
        }

        $this->carreras = carreras::orderBy('nombre')->get();
    }

    protected function rules()
    {
        return [
            'matricula' => 'required|max:10|unique:alumnos,alumno_id',
            'carrera_id' => 'required|exists:carreras,carrera_id',
            'nombre' => 'required|string|max:100',
            'a_paterno' => 'required|string|max:100',
            'a_materno' => 'required|string|max:100',
            'sexo' => 'required|in:M,F',
            'semestre' => 'required|integer|min:1|max:12',
        ];
    }

    public function saveAlumno()
    {
        // Validar los datos antes de guardar
        $validatedData = $this->validate();

        DB::beginTransaction();
        try {
            alumnos::create([
                'alumno_id' => $this->matricula,
                'user_id' => Auth::user()->id,
                'carrera_id' => $this->carrera_id,
                'nombre' => $this->nombre,
                'a_paterno' => $this->a_paterno,
                'a_materno' => $this->a_materno,
                'sexo' => $this->sexo,
                'semestre' => $this->semestre,
            ]);

            session()->flash('message', '¡Alumno registrado exitosamente!');

            DB::commit();
            $this->reset(['carrera_id', 'nombre', 'a_paterno', 'a_materno', 'sexo', 'semestre']);

            $this->sexo = 'M';
            $this->semestre = 1;
            return redirect()->route('alumnos.panel');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
        }
    }

    public function render()
    {
        return view('livewire.modules.users.alumnos.complete-profile');
    }
}
