<?php

use Illuminate\Database\Seeder;

class PefilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('profiles')->insert([
            ['per_nome' => "Administrador"],
           [ 'per_nome' => "Cliente"]

        ]);
    }
}
