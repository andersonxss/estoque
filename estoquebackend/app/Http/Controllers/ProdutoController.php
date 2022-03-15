<?php

namespace App\Http\Controllers;

use App\Status;
use Illuminate\Http\Request;
use App\Produto;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class ProdutoController extends Controller
{
    protected $repository;
    protected $produto_desconto;

    public function __construct(Produto $produto,ProdutoDescontoController $produto_desconto)
    {
        $this->repository = $produto;
        $this->produto_desconto = $produto_desconto;
    }

    public function index()
    {
        $retorno = DB::table('produtos')
            ->join('status', 'status.sta_id', '=', "pro_id_sta")
            ->where([['pro_id_sta','=', 1],['pro_quantidade','>', 0]])
            ->get();
            
        return $retorno;
    }

    public function store(Request $request)
    {
       
       $this->validate($request, [
            'pro_nome'    => 'required|unique:produtos',
            'pro_quantidade'   => 'required',
            'pro_valor' => 'required'
        ]);


         $retorno = $this->repository->create([
            'pro_nome' => $request['pro_nome'],
            'pro_quantidade' => $request['pro_quantidade'],
            'pro_valor' => $request['pro_valor'],
            'pro_id_sta' => 1
        ]);

      
         //Se status for igual a true e valueDesconto for > 0
        //Deve-se relacionar o id do produto com id do desconto
       if ($retorno && $request->status == true && $request->valueDesconto > 0){
           $this->produto_desconto->setProdutoDesconto($retorno->id,$request->valueDesconto);

       }

        return $retorno;
    }

    public function update(Request $request, $id)
    {
        //Verificar se existe Produto cadastrado com esse id
        $produtos = $this->CheckedDadosTable($id);

        //Se existir
        if ($produtos) {

            $retorno = $produtos->update(
                [
                    'pro_nome'=>$request->pro_nome,
                    'pro_quantidade'=>$request->pro_quantidade,
                    'pro_valor'=>$request->pro_valor,
                ]
            );

            //Se status for igual a true e valueDesconto for > 0
            //Deve-se relacionar o id do produto com id do desconto
            if ($retorno && $request->status == true && $request->valueDesconto > 0){
                $this->produto_desconto->setProdutoDesconto($id,$request->valueDesconto);

            }

            return $retorno;
        }
    }

    public function desativar($id)
    {
        //Verificar se existe Produto cadastrado com esse id
        $produtos = $this->CheckedDadosTable($id);
        $pro_id_sta = $produtos->first()->pro_id_sta;
        //Se existir
        if ($produtos) {
            $retorno = $produtos->update(['pro_id_sta'=>($pro_id_sta==2?1:2)]);
            return $retorno;
        }
    }

    public function destroy($id)
    {
        //Verificar se existe Produto cadastrado com esse id
        $produtos = $this->CheckedDadosTable($id);

        //Se existir
        if ($produtos) {
            return $produtos->delete();
        }
    }

    public function show($pro_id){
        
        $produtos = $this->repository->where('pro_id',$pro_id)
            ->leftJoin('produto_desconto', 'produto_desconto.pro_des_id', '=', 'produtos.pro_id')
            ->leftJoin('descontos', 'descontos.des_id', '=', 'produto_desconto.des_pro_id')
            ->first();
        if ($produtos) {
          return $produtos;
        }
    }

    public function CheckedDadosTable($id){

        return $this->repository->where('pro_id',$id);

    }

     public function SetSubtrairProdutos($id,$quantidade){
        //Realizar baixa de  quantidade relacionado ao produto
         return $this->repository->where('pro_id',$id)->decrement('pro_quantidade',$quantidade);
     
     }

     public function SetAdicionarProdutoQuantidade($id,$quantidade){
       
        //Adicionar quantidade relacionado ao produto
        return $this->repository->where('pro_id',$id)
        ->increment('pro_quantidade',$quantidade);
    
    }





}
