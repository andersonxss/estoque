<?php

use Illuminate\Database\Seeder;

class DescontoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('descontos')->insert([
            'des_regra_two' => 5,
            'des_regra_one' => 9,
            'des_valor' => 500,
            'des_porcentagem' => 15,
        ]);
    }
}
