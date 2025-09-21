<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class diasHorarios extends Model
{
    protected $table = 'dias_horarios';

    protected $primaryKey = 'dia_horario_id';

    protected $fillable = [
        'dia_horario_id',
        'horario_id',
        'dia_id',
    ];
    public function horario(): BelongsTo
    {
        return $this->BelongsTo(horariosTalleres::class, 'horario_id', 'horario_id');
    }
    public function dia(): BelongsTo
    {
        return $this->BelongsTo(diasSemana::class, 'dia_id', 'dia_id');
    }


     use HasFactory;
}
