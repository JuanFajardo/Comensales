<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mesa extends Model
{
    use HasFactory;

    protected $fillable = [
        //'mesa', 'codigo', 'descripcion', 'baja',
        'id', 'mesa', 'codigo', 'descripcion', 'id_mesero', 'mesero', 'id_cliente', 'cliente', 'cantidad_comensales', 'ocupado', 'baja',
    ];
}