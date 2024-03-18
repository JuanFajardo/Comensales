<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Almacen extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_menu',
        'id_submenu',
        'id_producto',
        'precio_compra',
        'precio_venta',
        'fecha_peticion',
        'fecha_entrega',
        'cantidad_entrada',
        'cantidad_salida',
        'observacion'
    ];
}