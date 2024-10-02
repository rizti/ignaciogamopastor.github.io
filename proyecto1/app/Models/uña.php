<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class uña extends Model
{
    use HasFactory;
    protected $table = 'unas'; 

    protected $fillable = [
        'nombre', 
        'imagen',
         'precio', 
         'forma', 
         'categoria', 
         'tipo'
    ];
}   