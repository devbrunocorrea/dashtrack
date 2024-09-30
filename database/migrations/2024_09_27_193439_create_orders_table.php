<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tinyerp_pedidos', function (Blueprint $table) {
            $table->id();
            $table->integer('numero');
            $table->string('numero_ecommerce')->nullable();
            $table->dateTime('data_pedido');
            $table->dateTime('data_prevista')->nullable();
            $table->string('nome');
            $table->float('valor', 8, 2);
            $table->integer('id_vendedor');
            $table->json('nome_vendedor');
            $table->string('situacao');
            $table->string('codigo_rastreamento')->nullable();
            $table->string('url_rastreamento')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
