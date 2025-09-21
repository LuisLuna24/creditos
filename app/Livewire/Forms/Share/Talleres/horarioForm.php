<?php

namespace App\Livewire\Forms\Share\Talleres;

use App\Models\diasSemana;
use App\Models\horariosTalleres;
use Livewire\Attributes\Validate;
use Livewire\Form;

class horarioForm extends Form
{
    public $dia_inicio, $dia_fin, $hora_inicio, $hora_fin, $periodo, $cupo, $dias = [];
    public $diasSemana = [];

    public function searchDias()
    {
        $this->diasSemana = diasSemana::where('estatus', 1)->get();
    }

    public function validateForm()
    {
        $this->validate([
            'dia_inicio' => 'required|date',
            'dia_fin' => 'required|date|after:dia_inicio',
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i|after:hora_inicio',
            'periodo' => 'required|string|max:255',
            'cupo' => 'required|integer|min:10|max:50',
            'dias' => 'required|array'
        ], [
            'dias.*' => 'Debe seleccionar al menos un día de la semana.'
        ]);
    }

    public function save($taller, $docente, $id = null)
    {

        $dataToSave = [
            'taller_id'  => $taller,
            'docente_id' => $docente,
            'dia_inicio' => $this->dia_inicio,
            'dia_fin' => $this->dia_fin,
            'hora_inicio' => $this->hora_inicio,
            'hora_fin' => $this->hora_fin,
            'periodo' => $this->periodo,
            'cupo' => $this->cupo,
        ];

        $horarios = horariosTalleres::updateOrCreate(['horario_id' => $id], $dataToSave);

        $horarios->dias()->sync($this->dias);
    }

    public function resetForm()
    {
        $this->reset([
            'taller_id',
            'docente_id',
            'hora_inicio',
            'hora_fin',
            'dia_inicio',
            'dia_fin',
            'periodo',
            'cupo',
            'dias'
        ]);
    }

    public function searchData($id)
    {
        $data = horariosTalleres::find($id);
        $this->dia_inicio = \Carbon\Carbon::parse($data->dia_inicio)->format('Y-m-d'); // <-- FORMATO CORREGIDO
        $this->dia_fin = \Carbon\Carbon::parse($data->dia_fin)->format('Y-m-d');       // <-- FORMATO CORREGIDO
        $this->hora_inicio = \Carbon\Carbon::parse($data->hora_inicio)->format('H:i'); // <-- Este ya estaba bien
        $this->hora_fin = \Carbon\Carbon::parse($data->hora_fin)->format('H:i');       // <-- Este ya estaba bien

        // El resto de tus asignaciones están perfectas
        $this->periodo = $data->periodo;
        $this->cupo = $data->cupo;
        $this->dias = $data->dias->pluck('dia_id')->toArray();
    }
}
