<?php

namespace App\Livewire\Modules\Users\Admin\Alumno;

use App\Livewire\Forms\Share\Users\dataForm;
use App\Livewire\Forms\Share\Users\userForm;
use App\Models\carreras;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Locked;
use Livewire\Component;

class Create extends Component
{
    public dataForm $dataForm;
    public userForm $userForm;
    public $carreras = [];

    public function mount()
    {
        $this->carreras = carreras::where('estatus', 1)->orderBy('nombre', 'asc')->get();

        $this->resetSteps();
    }

    #[Locked]
    public $totalSteps;

    public $currentStep;

    #[Locked]
    public $porcentaje;

    public $titles = [
        '1' => 'Datos del usuario',
        '2' => 'Datos del alumno',
        '3' => 'Resumen',
    ];

    public function updated_porcentaje()
    {
        // Asegurar que el porcentaje llegue a 100% en el último paso
        $this->porcentaje = min(100, ($this->currentStep / $this->totalSteps) * 100);
    }

    public function increaseStep()
    {
        $this->validateData();
        $this->currentStep = min($this->currentStep + 1, $this->totalSteps);
        $this->updated_porcentaje();
    }

    public function decreaseStep()
    {
        $this->currentStep = max($this->currentStep - 1, 1);
        $this->updated_porcentaje();
    }

    public function validateData()
    {
        switch ($this->currentStep) {

            case 1:
                $this->userForm->validateUser();
                break;
            case 2:
                $this->dataForm->validateFormAlumnos();
                break;
        }
    }

    public function resetSteps()
    {
        $this->totalSteps = 3;
        $this->currentStep = 1;
        $this->updated_porcentaje();
    }

    public function submitForm(){
        DB::beginTransaction();
        try{

            $this->userForm->createUser();
            $this->dataForm->createAlumno($this->userForm->userId);

            DB::commit();
            $this->notifications('success','Alumnos','El alumno se ha agregado correctamente');
            $this->resetSteps();
            $this->userForm->resetUser();
            $this->dataForm->resetData();
        }catch(\Exception $e){
            DB::rollBack();
            dd($e->getMessage());
            $this->notifications('danger','Alumnos','Lo sentimos, que ha ocurrido un error. Si el problema persiste, contacte al área de sistemas');
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
        return view('livewire.modules.users.admin.alumno.create');
    }
}
