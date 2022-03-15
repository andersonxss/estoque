<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Illuminate\Support\Facades\Validator;
class authController extends Controller
{
    public function login(Request $request){



        $this->validate($request, [
            'email'    =>  'email:rfc,dns|required',
            'password'    =>  'required',
          
        ]);
       
        $login = Auth::attempt(['email' => $request->email, 'password' => $request->password]);
       
        if( $login ){

            $user  = Auth::user();
            $token = $user->createToken($request->deviceName)->plainTextToken;

          
             //Login Successful 
            $response = array('success' => true,'token' => $token,'usuario'=>Auth::user());
 
           
            return $response;
        }
        else{
 
            $response = array('success' => false, 'message' => 'Invalid login credentials');
                return $response;
            //return response()->json($response);
        }
     }


 public function me(Request $request)
 {
    $client = $request->user();

     return $client;
 }

 public function logout(Request $request)
 {
     $client = $request->user();

     // Revoke all tokens client...
     $client->tokens()->delete();

     return response()->json([], 204);
 }
}
