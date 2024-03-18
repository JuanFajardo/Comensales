<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlmacensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('almacens', function (Blueprint $table) {
            $table->id();
            $table->integer('id_menu');
            $table->integer('id_submenu');
            $table->integer('id_producto');
            $table->float('precio_compra', 6,2);
            $table->float('precio_venta', 6,2);
            $table->dateTime('fecha_peticion');
            $table->dateTime('fecha_entrega');
            $table->float('cantidad_entrada', 6,2);
            $table->float('cantidad_salida', 6,2);
            $table->text('observacion');
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
        Schema::dropIfExists('almacens');
    }
}
