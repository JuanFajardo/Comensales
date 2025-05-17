<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVentadetallesTable extends Migration
{
    public function up()
    {
        Schema::create('ventadetalles', function (Blueprint $table) {
            $table->id();
            $table->integer('id_venta');
            $table->integer('id_producto');
            $table->integer('id_menu');
            $table->integer('id_submenu');
            $table->string('titulo')->comment('producto es el nombre');
            $table->string('tipo_comanda');
            
            $table->float('cantidad', 6,2);
            $table->float('precio', 6,2);
            $table->float('total', 6,2);
            
            $table->integer('id_mesa');
            $table->string('mesa');
            $table->integer('id_mesero');
            $table->string('mesero');
            $table->integer('id_cliente');
            $table->string('cliente');
            $table->integer('cantidad_comensales');
            $table->string('ocupado');
            $table->string('ip');
            
            $table->string('pago_cantidad')->default('0');    //Cuantoas personas pagara
            $table->string('pago_costo')->default('0');       //cuanto de dinero pagara

            $table->string('tipo_pago')->default('NO');

            $table->string('tipo_pedido')->default('mesa'); //para mesa o para llevar
            $table->string('comentario_pedido')->default(' '); //si quieren algo especial en su plato de comida
            
            $table->dateTime('fecha_pago');
            $table->string('eliminacion_comentario');
            $table->string('eliminacion');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ventadetalles');
    }
}
