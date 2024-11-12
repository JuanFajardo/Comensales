<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
            $table->dateTime('fecha_pedido');
            $table->dateTime('fecha_pago');
            $table->integer('id_mesero');
            $table->string('mesero');
            $table->integer('id_cajero');
            $table->string('cajero');
            $table->string('comensales');
            $table->string('total');
            $table->string('ip');
            $table->string('tipo_pago');
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
        Schema::dropIfExists('ventas');
    }
}
