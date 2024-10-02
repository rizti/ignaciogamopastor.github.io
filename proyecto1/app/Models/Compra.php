<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;

    protected $table = 'carrito';
    public $timestamps = false;

    protected $fillable = [
        'idUsuario',
        'nombre',
        'precio',
        'categoria',
        'tipo',
        'color',
        'tamaño',
        'cantidad'
    ];

}