<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Cliente',
            'email' => 'cliente@gmail.com',
            'password' => bcrypt('12345678'),
            'use_id_per' => 2,
            'use_cpf' => 11111111111,
        ]);
    }
}
