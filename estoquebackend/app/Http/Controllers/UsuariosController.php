<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
class UsuariosController extends Controller
{
    protected $repository;

    public function __construct(User $user)
    {
        $this->repository = $user;
       
    }

    public function index()
    {
        $retorno = DB::table('users')
        ->select("users.id","users.name","users.email","profiles.per_id","profiles.per_nome","status.sta_id","status.sta_nome")
        ->join('profiles', 'profiles.per_id', '=', "use_id_per")
        ->join('status', 'status.sta_id', '=', "use_id_sta")
        ->get();
        
        return $retorno;
    }


    public function store(Request $request)
    {

       

        $this->validate($request, [
            'name'    => 'required',
            'email'   => 'required|unique:users',
            'use_id_per' => 'required',
            'use_cpf' => 'required|unique:users',
           
        ]);
       
        $retorno = $this->repository->create(

            [
                'name' => $request['name'],
                'email' => $request['email'],
                'use_id_per' => $request['use_id_per'],
                'use_cpf' => $request['use_cpf'],
                'password' => Hash::make($request['use_cpf']),
            ]
        );
    

        return $retorno;
    }


    public function show($id){
        $retorno = $this->repository->where('id',$id)
        ->join('profiles', 'profiles.per_id', '=', "use_id_per")
            ->first();
        if ($retorno) {
          return $retorno;
        }
    }


    public function update(Request $request, $id)
    {


       
        //Verificar se existe Produto cadastrado com esse id
        $usuario = $this->CheckedDadosTable($id);
       
        //Se existir
        if ($usuario) {

            $this->validate($request, [
                'name'    => 'required',
                'email'   => 'required',
                'use_id_per' => 'required',
                'use_cpf' => 'required',
               
            ]);

            $retorno = $usuario->update(
                [

                'name' => $request->name,
                'email' => $request->email,
                'use_id_per' => $request->use_id_per,
                'use_cpf' => $request->use_cpf,
            
                ]
            );


            return $retorno;
        }
    }

    
    public function CheckedDadosTable($id){

        return $this->repository->where('id',$id);

    }
}
