<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $table = 'produtos';

    protected $fillable = [
        'pro_nome',
        'pro_quantidade',
        'pro_valor',
        'pro_id_sta'
    ];


}
