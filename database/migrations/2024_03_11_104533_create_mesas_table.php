<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMesasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mesas', function (Blueprint $table) {
            $table->id();
            $table->string('mesa');
            $table->string('codigo');
            $table->text('descripcion')->nullable();

            $table->integer('id_mesero')->comment('idenditificadro del mesero a cargo ');
            $table->string('mesero')->comment('idenditificadro del mesero a cargo ');
            $table->integer('id_cliente')->comment('idenditificadro del cliente  ');
            $table->string('cliente')->comment('idenditificadro del cliente  ');
            $table->string('cantidad_comensales')->nullable()->comment('numero de comensales');
            $table->string('ocupado')->comment('hora/0 con hora se vera que hora fue ocupado');

            $table->boolean('baja')->default(0); // Valor 0 o 1 para indicar baja
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
        Schema::dropIfExists('mesas');
    }
}