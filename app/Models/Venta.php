<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;
    protected $fillable = [
            'fecha_pedido',
            'fecha_pago',
            
            'id_mesero',
            'mesero',
            'id_cajero',
            'cajero',

            'cliente',
            'id_cliente',
            'pago',

            'cierre',
            'fecha_cierre',
            'id_cierre',
                        
            'comensales',
            'total',
            'ip',
            'tipo_pago', 

            'registro',
            'registro_efectivo',
            'registro_tarjeta',
            'adelanto_efectivo',
            'adelanto',
            'comentario'

    ];
    protected $table = 'ventas';

    public function detalles(){
        return $this->hasMany(VentaDetalle::class, 'id_venta');
    }

    public function usuario(){
        return $this->belongsTo(User::class, 'id_user');
    }
}
