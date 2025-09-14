<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class creditosAlumnos extends Model
{
    protected $table = 'creditos_alumnos';
    protected $primaryKey = 'credito_id';

    protected $fillable = [
        'alumno_id',
        'docente_id',
        'taller_id',
        'estatus',
    ];

    public function alumno(): BelongsTo
    {
        return $this->belongsTo(alumnos::class, 'alumno_id', 'alumno_id');
    }

    public function docente(): BelongsTo
    {
        return $this->belongsTo(docentes::class, 'docente_id', 'docente_id');
    }

    public function taller(): BelongsTo
    {
        return $this->belongsTo(talleres::class, 'taller_id', 'taller_id');
    }

    use HasFactory;
}
