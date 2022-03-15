<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Desconto;


class DescontoController extends Controller
{

    protected $repository;

    public function __construct(Desconto $desconto)
    {
        $this->repository = $desconto;
    }

    public function index()
    {
        $retorno = $this->repository->get();
        return $retorno;
    }

    public function store(Request $request)
    {

        $retorno = $this->repository->create($request->all());
        return $retorno;
    }

    public function update(Request $request, $id)
    {
        //Verificar se existe desconto cadastrado com esse id
        $desconto = $this->CheckedDadosTable($id);

        //Se existir
        if ($desconto) {
            return $desconto->update($request->all());
        }
    }

    public function destroy($id)
    {
        //Verificar se existe desconto cadastrado com esse id
        $desconto = $this->CheckedDadosTable($id);

        //Se existir
        if ($desconto) {
           return $desconto->delete();
        }
    }

    public function CheckedDadosTable($id){

        return $this->repository->where('des_id',$id);

    }



}
