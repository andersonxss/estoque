<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produto_desconto extends Model
{
    protected $table = 'produto_desconto';

    protected $fillable = [
        'pro_des_id',
        'des_pro_id',

    ];
}
