<?php

namespace Test\Http\Controllers;

use Test\Http\Requests;
use Illuminate\Http\Request;
use DB;
use Test\User;
use Hash;

class FirebaseTestController extends Controller
{
    public function loginAttempt(Request $request)
    {
        $user = User::where('username',$request->username)->first();
        if ($user) {
            if(Hash::check($request->password, $user->password)){                
                return response()->json(['message' => 'success','userID' => $user->username]);
            }else{
                return response()->json(['message' => 'contrasenia' ]);
            }  
        }else{
            return response()->json(["message"=>"nosucess"]);            
        }
    }
    public function register(Request $request)
    {
        $user = new User;
        $user->username = $request->username;
        $user->password = bcrypt($request->password);
        if($user->save()){
            return response()->json(['message' => 'success','userID' => $user->username]);
        }else{
            return response()->json(['message' => 'nosucess']);
        }
    }
}
