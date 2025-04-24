<?php

// app/Models/Medico.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Medico extends Authenticatable // or extends Model if not using auth
{
    protected $fillable = [
        'nome', 
        'email', 
        'senha', 
        'cpf', 
        'telefone', 
        'crm', 
        'especialidade'
    ];
    
    // If using authentication, you might need:
    protected $hidden = [
        'senha',
        'remember_token',
    ];
    
    // If your password column isn't 'password'
    public function getAuthPassword()
    {
        return $this->senha;
    }
}