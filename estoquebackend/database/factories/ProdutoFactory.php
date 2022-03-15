<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Produto;
use Faker\Generator as Faker;

$factory->define(Produto::class, function (Faker $faker) {
    return [
        'pro_nome'=> $faker->company,
        'pro_quantidade'=> 10,
        'pro_valor'=> rand(100,100000),
        'pro_id_sta'=> 1,
    ];
});
