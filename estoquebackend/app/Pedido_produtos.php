<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido_produtos extends Model
{
    protected $table = 'pedido_produtos';

    protected $fillable = [
        'pep_quantidade',
        'pep_valor_pro',
        'pep_id_use',
        'pep_id_pro',
        'pep_id_ped',
        'pep_valor_pro_desconto',

    ];
}
