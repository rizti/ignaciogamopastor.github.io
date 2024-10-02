<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // Importar la clase Authenticatable

class Usuario extends Authenticatable // Extender Authenticatable
{
    protected $table = 'usuario';

    protected $fillable = ['nombre', 'clave', 'tipo', 'correo'];

    protected $rememberTokenName = null; 

    protected $casts = [
        'tipo' => 'integer', // Para asegurarte de que 'tipo' sea siempre un entero
    ];
}
