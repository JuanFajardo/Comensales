<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submenu extends Model
{
    use HasFactory;

    protected $fillable = [
        'img', 'id_menu', 'submenu', 'descripcion', 'peso', 'precio_compra', 'precio_venta', 'promocion', 'baja'
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'id_menu');
    }
}