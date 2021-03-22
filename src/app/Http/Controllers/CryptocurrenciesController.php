<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cryptocurrency;

class CryptocurrenciesController extends Controller
{
    public function list(){
        $cc = Cryptocurrency::all();
        $res = array();
        foreach($cc as $c){
            $res[] = '('.$c->code.')'.' '.$c->name;
        }
        return response()->json($res);
    }
}
