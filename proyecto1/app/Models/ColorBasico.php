<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ColorBasico extends Model
{
    use HasFactory;

    protected $table = 'colorbasico'; 


    protected $fillable = [
        'color',
        'stock',
    ];
}

?>