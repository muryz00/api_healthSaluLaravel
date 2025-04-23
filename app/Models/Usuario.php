<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $fillable = [
        'nome',
        'email',
        'senha',
        'tipo', // 'paciente' ou 'medico'
    ];

    protected $hidden = ['senha'];
}
