<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detalles extends Model
{
    use HasFactory;
    protected $table = 'ventadetalles';
    protected $fillable = [
        'id', 
        'id_producto',
                'id_menu',
                'id_submenu',
                'titulo',
                
                'cantidad',
                'precio',
                'total',

                'id_mesa',
                'mesa',

                'id_mesero',
                'mesero',

                'id_cliente',
                'cliente',

                'cantidad_comensales',
                
                'ip',

                'tipo_pago',
                'fecha_pago',
        ];

}
