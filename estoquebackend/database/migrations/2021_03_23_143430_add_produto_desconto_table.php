<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProdutoDescontoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produto_desconto', function (Blueprint $table) {
            $table->integer('pro_des_id')->unsigned();
            $table->foreign('pro_des_id')->references('pro_id')->on('produtos');
            $table->integer('des_pro_id')->unsigned();
            $table->foreign('des_pro_id')->references('des_id')->on('descontos');
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
