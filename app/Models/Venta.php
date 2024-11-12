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
            'tipo_pago',
            'comensales',
            'total',
            'ip'
    ];
    protected $table = 'ventas';

    public function detalles(){
        return $this->hasMany(VentaDetalle::class, 'id_venta');
    }

    public function usuario(){
        return $this->belongsTo(User::class, 'id_user');
    }
}
