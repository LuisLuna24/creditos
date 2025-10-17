<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class diasSemana extends Model
{
    protected $table = 'dias_semanas';

    protected $primaryKey = 'dia_id';

    protected $fillable = [
        'dia_id',
        'nombre',
        'estatus',
    ];

    public function horarios()
    {
        return $this->belongsToMany(horariosTalleres::class, 'dias_horarios', 'dia_id', 'horario_id');
    }

    use HasFactory;
}
