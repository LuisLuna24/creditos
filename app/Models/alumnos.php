<?php

namespace App\Models;

use App\Enums\sexoEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class alumnos extends Model
{
    protected $table = 'alumnos';

    protected $primaryKey = 'alumno_id';

    protected $fillable = [
        'alumno_id',
        'user_id',
        'nombre',
        'a_paterno',
        'a_materno',
        'carrera_id',
        'sexo',
        'semestre',
        'estatus',
    ];

    protected $casts = [
        'sexos' => sexoEnum::class,
    ];

    public function user(): BelongsTo
    {
        return $this->BelongsTo(User::class, 'user_id');
    }

    public function carrera(): BelongsTo
    {
        return $this->BelongsTo(carreras::class,'carrera_id','carrera_id');
    }

    public function horarios(): BelongsToMany
    {
        return $this->BelongsToMany(horariosTalleres::class, 'alumno_id', 'horario_id');
    }

    public function creditos(): HasMany
    {
        return $this->HasMany(creditosAlumnos::class,'alumno_id','alumno_id');
    }

    use HasFactory;
}
