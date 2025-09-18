<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class horariosTalleres extends Model
{
    use HasFactory;

    protected $table = 'horarios_talleres';

    protected $primaryKey = 'horario_id';

    protected $fillable = [
        'docente_id',
        'taller_id',
        'hora_inicio',
        'hora_fin',
        'cupo',
        'periodo',
        'estatus',
    ];
    protected $casts = [
        'hora_inicio' => 'datetime:H:i',
        'hora_fin' => 'datetime:H:i',
    ];

    public function taller(): BelongsTo
    {
        return $this->belongsTo(talleres::class, 'taller_id', 'taller_id');
    }

    public function docente(): BelongsTo
    {
        return $this->belongsTo(docentes::class, 'docente_id', 'docente_id');
    }

    public function dias(): BelongsToMany
    {
        return $this->belongsToMany(diasSemana::class, 'dias_horarios', 'horario_id', 'dia_id');
    }

    public function alumnos(): BelongsToMany
    {
        // Se asume que el modelo del alumno se llama 'Alumno' y la tabla pivote 'horarios_alumnos'
        return $this->belongsToMany(alumnos::class, 'horarios_alumnos', 'horario_id', 'alumno_id');
    }
}
