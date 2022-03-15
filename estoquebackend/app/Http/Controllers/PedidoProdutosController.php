<?php

namespace App\Http\Controllers;

use App\Pedido_produtos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PedidoProdutosController extends Controller
{
    protected $repository;
    protected $produtos;
    protected $pedido;
   

    public function __construct(Pedido_produtos $Pedido_produtos, ProdutoController $produtos,PedidoController $pedido)
    {
        $this->repository = $Pedido_produtos;
        $this->produtos = $produtos;
        $this->pedido = $pedido;
    }

    public function store(Request $request){

       
        //Adicionar produto relacionado com o id do pedido
        $retorno = $this->repository->create(
            [
                'pep_quantidade'=>$request->pep_quantidade,
                'pep_valor_pro'=>$request->pep_valor_pro,
                'pep_id_pro'=>$request->pep_id_pro,
                'pep_id_ped'=>$request->pep_id_ped,
                'pep_id_use'=>$request->pep_id_use,
                'pep_valor_pro_desconto'=>0
            ]

        );
        

        $retornoprodutos =  $this->produtos->show($request->pep_id_pro);
        return json_encode([
            "produtos"=>$retornoprodutos,
            "pedidosproduto"=>$retorno,
            
        ]);
    }

    public function update(Request $request, $id){
        //dd($request);
        $return = '';
       // return $id;
        //Atualizar os dados dos produtos relacionado com os pedidos
        foreach ($request->produtos as $value) {
            // echo $value['pep_id'].' <br/>';
            //   $valor_desconto = $value['pep_valor_pro_desconto']?$value['pep_valor_pro_desconto']:0;
            // echo "Quantidade:".$value['pep_quantidade'].' <br/>';
            // echo "Valor Produto:".$value['pep_valor_pro'].' <br/>';
            //  echo "Valor Desconto:".$value['pep_valor_pro_desconto'].' <br/>';
           

            
            $return.= $this->repository->where('pep_id',$value['pep_id'])->update(
               [
                    'pep_quantidade'=>intval($value['pep_quantidade']),
                    'pep_valor_pro'=>$value['pep_valor_pro'],
                    'pep_valor_pro_desconto'=> $value['pep_valor_pro_desconto']
                ]
            );
   
            //Apos os dados serem atualizado, deve-se dar baixa de estoque do produtos
            $this->produtos->SetSubtrairProdutos($value['pep_id_pro'],$value['pep_quantidade']);
        }

     
        
        if ($return) {
            $retornoPreco = $this->CheckedDadosPrecoPedido($id);
             $this->pedido->updatePrecoPedido($id,$retornoPreco->sum('pep_valor_pro'),$retornoPreco->sum('pep_valor_pro_desconto'),5);

            //Pegando o pedido dos produtos
             return $this->pedido->CheckedDadosTable($id)->first();
           
        } else {
          return false;
        }
    }

    public function index($id){
        //Buscar todos itens cadastrado que esteja relacionado com o pedido
        $pedido_produtos = DB::table('pedido_produtos')
            ->join('produtos', 'produtos.pro_id', '=', "pep_id_pro")
            ->leftJoin('produto_desconto', 'produto_desconto.pro_des_id', '=', "pep_id_pro")
            ->leftJoin('descontos', 'descontos.des_id', '=', "des_pro_id")
            ->where("pep_id_ped",$id)
            ->get();

        //Pegando o pedido dos produtos
        $pedido = $this->pedido->CheckedDadosTable($id)->first();
                
        return json_encode(array("pedido_produtos"=> $pedido_produtos,"pedido"=> $pedido));
    }

    public function destroy(Request $request, $pep_id){
   
        //Verificar se existe  esse id
        $produtos_pedido = $this->CheckedDadosTable($pep_id);

        $produto = $produtos_pedido->first();

        //Se existir
        if ($produtos_pedido) {
            $retorno = $produtos_pedido->delete();

                if ($retorno) {
                    //Apos os dados serem apagados na tabela pedidos produtos, deve-se incrementar a quantidade no estoque do produtos
                    $this->produtos->SetAdicionarProdutoQuantidade($produto->pep_id_pro,$produto->pep_quantidade);
                    $retornoPreco = $this->CheckedDadosPrecoPedido($produto->pep_id_ped);         
                    return  $this->pedido->updatePrecoPedido($produto->pep_id_ped,$retornoPreco->sum('pep_valor_pro'),$retornoPreco->sum('pep_valor_pro_desconto'),6);
                }
            return $retorno;
        }
    }

    public function CheckedDadosTable($pep_id){

        return $this->repository->where('pep_id',$pep_id);

    }

    public function CheckedDadosPrecoPedido($id){

        return  DB::table('pedido_produtos')->where('pep_id_ped',$id)->get();
        

    }

}
