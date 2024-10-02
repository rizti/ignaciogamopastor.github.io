<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detallesCompras extends Model
{
    use HasFactory;

    protected $table = 'detallescompra'; 
    public $timestamps = false;

    protected $fillable = [
        'idCompra',
        'nombre',
        'precio',
        'categoria',
        'tipo',
        'color',
        'tamaño',
        'cantidad'
    ];
}

?>