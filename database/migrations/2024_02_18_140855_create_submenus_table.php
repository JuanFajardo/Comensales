<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubmenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submenus', function (Blueprint $table) {
            $table->id();
            $table->string('img')->nullable();
            $table->unsignedInteger('id_menu');
            $table->string('submenu');
            $table->text('descripcion');
            $table->float('peso', 6,2);
            $table->float('precio_compra', 6,2);
            $table->float('precio_venta', 6,2);
            $table->integer('promocion')->default(0); // Valor 0 o 1 para que este en primera lista
            $table->integer('baja')->default(0); // Valor 0 o 1 para indicar baja
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
        Schema::dropIfExists('submenus');
    }
}