<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pedido;
use Illuminate\Support\Facades\DB;


class PedidoController extends Controller
{

    protected $repository;

    public function __construct(Pedido $pedido )
    {
        $this->repository = $pedido;
       
    
    }

    public function index()
    {
        $retorno = DB::table('pedidos')
            ->select('pedidos.ped_id',
                        'pedidos.ped_valor_com_desconto',
                        'pedidos.ped_valor_sem_desconto',
                        'pedidos.created_at',
                        'pedidos.updated_at',
                        'users.name',
                        'status.sta_id',
                        'status.sta_nome')
            ->join('status', 'status.sta_id', '=', "ped_id_sta")
            ->join('users', 'users.id', '=', "ped_id_use")
            ->orderBy('pedidos.ped_id', 'desc')
            ->get();
        return $retorno;
    }

    public function store(Request $request)
    {
        $retorno = $this->repository->create($request->all());
         return $retorno;
    }

    public function update($id,$status)
    {
        //Verificar se existe Produto cadastrado com esse id
        $pedidos = $this->CheckedDadosTable($id);
       
        //Se existir
        if ($pedidos) {

            $retornoPreco = $this->CheckedDadosPrecoPedido($id);
            
            $retorno = $pedidos->update(
                [
                    'ped_valor_sem_desconto'=>$retornoPreco->sum('pep_valor_pro'),
                    'ped_valor_com_desconto'=>$retornoPreco->sum('pep_valor_pro_desconto'),
                    'ped_id_sta'=>$status,
                ]
            );
            
            return $retorno;
        }
    }

    public function encerrar($id)
    {
        //Verificar se existe Produto cadastrado com esse id
        $pedidos = $this->CheckedDadosTable($id);
        //Se existir
        if ($pedidos) {
            $retorno = $pedidos->update(['ped_id_sta'=>3]);
            return $retorno;
        }
    }

    public function updatePrecoPedido($id,$pep_valor_pro,$pep_valor_pro_desconto,$status)
    {   
       
        $pedidos = $this->CheckedDadosTable($id);
      
               //Se existir
        if ($pedidos) {
       return $pedidos->update(
                [
                    'ped_valor_sem_desconto'=>$pep_valor_pro,
                    'ped_valor_com_desconto'=>$pep_valor_pro_desconto,
                    'ped_id_sta'=>$status,
                ]
            );
         
    }
    }

    public function CheckedDadosTable($id){

        return $this->repository->where('ped_id',$id);

    }

  



}
