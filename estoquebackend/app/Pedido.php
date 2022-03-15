<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = 'pedidos';

    protected $fillable = [
        'ped_valor_com_desconto',
        'ped_valor_sem_desconto',
        'ped_id_sta',
        'ped_id_use'
    ];
}
