<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class horariosAlumnos extends Model
{
    protected $table = 'horarios_alumnos';

    protected $primaryKey = 'horario_alumno_id';

    protected $fillable = [
        'horario_alumno_id',
        'horario_id',
        'alumno_id',
        'estatus',
    ];

    public function alumno(): BelongsTo
    {
        return $this->BelongsTo(alumnos::class, 'alumno_id', 'alumno_id');
    }

    public function horarios(): BelongsTo
    {
        return $this->BelongsTo(horariosTalleres::class, 'horario_id', 'horario_id');
    }

    use HasFactory;
}
