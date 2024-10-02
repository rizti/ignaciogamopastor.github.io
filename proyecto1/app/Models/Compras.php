<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compras extends Model
{
    use HasFactory;

    protected $table = 'compra'; 
    protected $primaryKey = 'idCompra';
    public $timestamps = false;

    protected $fillable = [
        'idUsuario',
        'PrecioTot',
    ];
}

?>