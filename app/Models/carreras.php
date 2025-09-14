<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class carreras extends Model
{
    protected $table = 'carreras';

    protected $primaryKey = 'carrera_id';

    protected $fillable = [
        'carrera_id',
        'nombre',
        'estatus',
    ];

    public function alumnos()
    {
        return $this->hasMany(alumnos::class, 'carrera_id');
    }

    use HasFactory;
}
