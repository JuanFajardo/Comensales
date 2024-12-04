<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ventadetalle extends Model
{
    use HasFactory;
    protected $table = 'ventadetalles';
    protected $fillable = [
        'id_venta',
        'id_producto',
        'id_menu',
        'id_submenu',
        'titulo',
        'tipo_comanda',
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
        'ocupado',

        'pago_cantidad',
        'pago_costo',

        'tipo_pago',

        'tipo_pedido',
        'comentario_pedido',

        'ip',
        'fecha_pago',
        'eliminacion_comentario',
        'eliminacion',
    ];

   

    public function venta(){
        return $this->belongsTo(Venta::class, 'id_venta');
    }
}
