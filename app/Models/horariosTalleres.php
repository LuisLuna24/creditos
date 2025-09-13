<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class horariosTalleres extends Model
{
    protected $fillable = [
        'hora_inicio',
        'hora_fin',
        // otros campos que permitas llenar masivamente
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'hora_inicio' => 'datetime:H:i', // Formatea al recuperar: 24-hour format without seconds
        'hora_fin' => 'datetime:H:i',
    ];
}
