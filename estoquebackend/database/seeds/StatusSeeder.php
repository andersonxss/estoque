<?php

use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('status')->insert([
                        ['sta_nome' => 'Ativo'],
                        ['sta_nome' => 'Inativo'],
                        ['sta_nome' => 'Paga'],
                        ['sta_nome' => 'Cancelado'],
                        ['sta_nome' => 'Em análise'],
            ['sta_nome' => 'Pendente'],
        ]);
    }
}
