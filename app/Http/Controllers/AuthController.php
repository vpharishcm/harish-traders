<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use GuzzleHttp\Client;
use App\Http\Controllers;
use Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        
        $request->validate([
            'email'=>'required',
            'name'=>'required',
            'password'=>'required'
        ]);
        $user=new User();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=bcrypt($request->password);
        $user->save();

        $http = new Client;
        $response = $http->post('http://127.0.0.1:8000/oauth/token', [
            'form_params' => [
                'grant_type' => 'password',
                'client_id' => '2',
                'client_secret' => 'EgZ26JkYHzsSXtjr54AzCOJ5KLKiokdCrv8e60Uh',
                'username' => $request->email,
                'password' => $request->password,
                'scope' => '',
            ],
        ]);

        return response(['data'=>json_decode((string) $response->getBody(), true)]);
    }
   public function login(Request $request){
       $request->validate([
           'email'=>'required',
           'password'=>'required'
       ]);
       $user=User::where('email',$request->email)->first();
       if(!$user){
           return response(['status'=>'error','message'=>'User Not Found']);
       }

       if(Hash::check($request->password,$user->password)){
        $http = new Client;
        $data=[
        'form_params' => [
            '_token' => csrf_token(),
            'grant_type' => 'password',
            'client_id' => 2,
            'client_secret' => 'EgZ26JkYHzsSXtjr54AzCOJ5KLKiokdCrv8e60Uh',
            'username' => 'vpharishcm@gmail.com',
            'password' => '123456' ,
            
        ],
        'exceptions' => false,
        'connect_timeout' => 3.14,
        ];
    $response = $http->post(url('oauth/token'), $data);

    return response($response->getBody()->getContents());
       }else {
           return response(['status'=>'error','message'=>'Invalied Password']);
       }
   } 
}
