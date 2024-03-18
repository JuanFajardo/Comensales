<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_menu',
        'id_submenu',
        'producto',
        'precio',
        'peso_compra',
        'peso_venta',
        'baja',
    ];
}
