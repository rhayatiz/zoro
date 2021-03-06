<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Crypt;

class AppController extends Controller
{
    public function init(){
        $user = Auth::user();
        if(Auth::user()){
            $user = User::with('wallet.OwnedCrypto.Cryptocurrency')->find(Auth::user()->id);
        }else{
            $user = null;
        }

        return response()->json(['user' => $user], 200);
    }

    public function login(Request $request){
        if(Auth::attempt(['username' => $request->username, 'password' => $request->password], true)){
            return response()->json($this->init(), 200);
        }else{
            return response()->json(['error' => 'Identification impossible'], 401);
        };
    }

    public function register(Request $request){

        $user = User::where('username', $request->username)->first();
        if (isset($user)){
            return response()->json(['error' => 'Nom d\'utilisateur existant'], 401);
        }

        $user = new User();
        $user->name = $request->name;
        $user->username = $request->username;
        $user->password = bcrypt($request->password);
        $user->save();

        Auth::login($user);
        return response()->json($user, 200);
    }

    public function logout(){
        Auth::logout();
    }
}
