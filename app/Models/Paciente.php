<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    protected $fillable = [
        'nome',
        'cpf',
        'dataNasc',
        'email',
        'telefone',
        'senha'
    ];

    protected $hidden = ['senha'];
}
