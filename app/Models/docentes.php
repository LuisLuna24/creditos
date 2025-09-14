<?php

namespace App\Models;

use App\Enums\sexoEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class docentes extends Model
{
    protected $table = 'docentes';

    protected $primaryKey = 'docente_id';

    protected $fillable = [
        'user_id',
        'nombre',
        'a_paterno',
        'a_materno',
        'sexo',
        'estatus',
    ];

    protected $casts = [
        'sexos' => sexoEnum::class,
    ];

    public function user(): BelongsTo
    {
        return $this->BelongsTo(User::class,'user_id');
    }

    public function horarios(): HasMany
    {
        return $this->HasMany(horariosTalleres::class, 'docente_id', 'docente_id');
    }

    public function talleres(): HasMany
    {
        return $this->HasMany(talleres::class, 'docente_id', 'docente_id');
    }

    public function creditos(): HasMany
    {
        return $this->HasMany(creditosAlumnos::class,'alumno_id','alumno_id');
    }

    use HasFactory;
}
