<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('img');
            $table->string('menu');
            //$table->enum('tipo', ['refrescos', 'golosinas', 'helados']);
            $table->string('logo');
            $table->string('fondo');
            $table->text('descripcion');
            $table->float('baja')->default(0)->nullable(); // Valor entre 0 y 1
            $table->timestamps();
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('menus');
    }
}
