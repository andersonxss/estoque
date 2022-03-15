<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profiles;
use Illuminate\Support\Facades\DB;
class ProfilesController extends Controller
{
    protected $repository;

    public function __construct(Profiles $profiles)
    {
        $this->repository = $profiles;
       
    }

    public function index()
    {
        $retorno = DB::table('profiles')
    
        ->get();
        
        return $retorno;
    }
}
