<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class talleres extends Model
{
    protected $table = 'talleres';

    protected $primaryKey = 'taller_id';

    protected $fillable = [
        'taller_id',
        'docente_id',
        'nombre',
        'cupo',
        'estatus',
    ];

    public function docente(): BelongsTo
    {
        return $this->BelongsTo(docentes::class,'docente_id','docente_id');
    }

    public function horarios()
    {
        return $this->hasMany(horariosTalleres::class, 'taller_id');
    }

    use HasFactory;
}
