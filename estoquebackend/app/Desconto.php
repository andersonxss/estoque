<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Desconto extends Model
{
    protected $table = 'descontos';

    protected $fillable = [
        'des_regra_two',
        'des_regra_one',
        'des_valor',
        'des_porcentagem'
    ];
}
