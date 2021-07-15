<?php

namespace App\Http\Controllers;

use App\Cryptocurrency;
use App\Order;
use App\User;
use App\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function store(Request $request){
        if (Auth::user() != null || ($request->type != 'buy' && $request->type != 'sell')){
            $order = new Order();
            $order->type = $request->type;
            $order->price = $request->price;
            $order->quantity = $request->quantity;
            $order->cryptocurrency_id = Cryptocurrency::where('code',$request->cryptocurrencyCode)->first()->id;
            $order->user_id = Auth::user()->id;

            $order->save();

            if($order != null){
                //remove order ammount from available money
                $wallet_id = Auth::user()->wallet->id;
                $wallet = Wallet::find($wallet_id);
                $wallet->available_money = $wallet->available_money - $order->price;
                $wallet->save();
                return response()->json([
                    'order' => $order,
                    'user' => User::with('wallet')->find(Auth::user()->id)
                ], 200);
            }else{
                return response()->json(['error' => 'Erreur, ordre non executé.'], 401);
            }
        }
    }
}
