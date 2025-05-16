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

            $table->string('cliente');
            $table->integer('id_cliente');
            $table->string('pago');

            $table->string('cierre')->default('--')->nullable();
            $table->string('fecha_cierre')->default('--')->nullable();
            $table->integer('id_cierre')->default('0')->nullable();
                        
            $table->string('comensales');
            $table->string('total');
            $table->string('ip');
            $table->string('tipo_pago');

            $table->string('registro')->default('')->nullable();
            $table->float('registro_efectivo', 6,2)->default(0)->nullable();
            $table->float('registro_tarjeta', 6,2)->default(0)->nullable();
            $table->float('adelanto_efectivo', 6,2)->default(0)->nullable();
            $table->text('adelanto')->default('')->nullable();
            $table->text('comentario')->default('')->nullable();

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
