<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalles', function (Blueprint $table) {
            $table->id();
            $table->integer('id_venta');
            $table->integer('id_producto');
            $table->integer('id_menu');
            $table->integer('id_submenu');
            $table->string('titulo')->comment('producto es el nombre');
            $table->integer('cantidad');
            $table->float('precio', 6,2);
            $table->float('total', 6,2);
            
            $table->integer('id_mesa');
            $table->string('mesa');
            $table->integer('id_mesero');
            $table->string('mesero');
            $table->integer('id_cliente');
            $table->string('cliente');
            $table->integer('cantidad_comensales');
            
            $table->string('ip');
            $table->string('tipo_pago')->default('NO');
            $table->dateTime('fecha_pago');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalles');
    }
}
