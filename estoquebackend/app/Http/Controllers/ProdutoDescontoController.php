<?php

namespace App\Http\Controllers;
use App\Desconto;
use Illuminate\Http\Request;
use App\Produto_desconto;

class ProdutoDescontoController extends Controller
{

    protected $repository;
    protected $desconto;

    public function __construct(Produto_desconto $produto_desconto,Desconto $desconto)
    {
        $this->repository = $produto_desconto;
        $this->desconto = $desconto;
    }

    public function destroy($id)
    {
        //Verificar se existe  esse id
        $produtos_desconto = $this->CheckedDadosTable($id);

        //Se existir
        if ($produtos_desconto) {
            return $produtos_desconto->delete();
        }
    }

    public function GetDescontoProduto($id_produto,$quantidade,$valor){

        $desconto = $this->repository->where('pro_des_id', $id_produto)->first();

        if($desconto->count()>0){

            $des_pro_id  = $desconto->des_pro_id;
            $descontos   = $this->desconto->where('des_id', $des_pro_id)->first();
            $regra_one   = $descontos->des_regra_one;
            $regra_two   = $descontos->des_regra_two;
            $regra_valor = $descontos->des_valor;
            $regra_porcentagem = $descontos->des_porcentagem/100;

            //Se o valor entrar na regra deve-se gerar desconto no produto
            if ($regra_one>= $quantidade && $regra_two<=$quantidade && $valor>$regra_valor){

                 return $valor-($regra_porcentagem*$valor);

            }else{
                return "Fora!";

            }


        }



    }

    public function setProdutoDesconto($pro_des_id,$des_pro_id){
        $this->repository->create([
            'pro_des_id'=>$pro_des_id,
            'des_pro_id'=>$des_pro_id
        ]);

    }

    public function CheckedDadosTable($id){

        return $this->repository->where('pro_des_id',$id);

    }


   

}
