<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCreatePedidoProduto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedido_produtos', function (Blueprint $table) {
            $table->increments('pep_id');
            $table->integer('pep_quantidade');
            $table->float('pep_valor_pro', 8, 2);
            $table->integer('pep_id_use');

        });

        Schema::table('pedido_produtos', function ($table) {


            $table->integer('pep_id_pro')->unsigned();
            $table->integer('pep_id_ped')->unsigned();
            // $table->bigInteger('pep_id_use')->unsigned();
            $table->foreign('pep_id_pro')->references('pro_id')->on('produtos');
            $table->foreign('pep_id_ped')->references('ped_id')->on('pedidos');

            //   $table->foreign('pep_id_use')->references('id')->on('users');
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
        //
    }
}
