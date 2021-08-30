<?php

namespace App\Http\Controllers;

use App\Cryptocurrency;
use App\Order;
use App\OwnedCrypto;
use App\User;
use App\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function store(Request $request){
        if (Auth::user() != null || ($request->type != 'buy' && $request->type != 'sell')){
            $cryptocurrency_id = Cryptocurrency::where('code',$request->cryptocurrencyCode)->first()->id;

            $order = new Order();
            $order->type = $request->type;
            $order->price = $request->price;
            $order->quantity = $request->quantity;
            $order->cryptocurrency_id = $cryptocurrency_id;
            $order->user_id = Auth::user()->id;

            $order->save();

            if($order != null){
                $wallet_id = Auth::user()->wallet->id;
                //owned_crypto
                //si l'utilisateur possède déjà cette crypromonnaie, modifier la quantité
                $ownedCrypto = OwnedCrypto::where('wallet_id', $wallet_id)->where('cryptocurrency_id', $cryptocurrency_id)->first();
                if ($ownedCrypto != null){
                    $new_average_price = ($ownedCrypto->quantity + $order->quantity) / ($ownedCrypto->quantity + $order->price);
                    $ownedCrypto->quantity +=  $request->quantity;
                    $ownedCrypto->average_price +=  $new_average_price;
                //sinon, ajouter une entrée ownedCrypto
                }else{
                    $ownedCrypto = new OwnedCrypto();
                    $ownedCrypto->cryptocurrency_id  = $cryptocurrency_id;
                    $ownedCrypto->wallet_id  = $wallet_id;
                    $ownedCrypto->quantity  = $request->quantity;
                    $ownedCrypto->average_price  = $request->price;
                }
                $ownedCrypto->save();

                //remove order ammount from available money
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

    public function list(){
        if(Auth::user()){
            $orders = Order::with('Cryptocurrency')->where('user_id', Auth::user()->id)->latest()->get();
            return response()->json(['orders' => $orders], 200);
        }
    }
}
