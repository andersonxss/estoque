<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->increments('ped_id');
            $table->float('ped_valor_com_desconto', 8, 2);
            $table->float('ped_valor_sem_desconto', 8, 2);
            $table->integer('ped_id_sta')->unsigned();
            $table->timestamps();
            $table->foreign('ped_id_sta')->references('sta_id')->on('status');



        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pedidos');
    }
}
