<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->integer('id_menu');
            $table->integer('id_submenu');
            $table->string('producto');
            $table->string('precio');
            $table->string('peso_compra');
            $table->string('peso_venta');
            $table->string('promocion')->comment('si/no');
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
        Schema::dropIfExists('productos');
    }
}