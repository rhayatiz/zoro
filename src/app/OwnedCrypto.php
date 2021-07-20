<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OwnedCrypto extends Model
{
    protected $table = 'owned_crypto';
    protected $fillable = ['cryptocurrency_id', 'wallet_id', 'quantity', 'average_price'];
    public $timestamps = true;

    public function wallet()
    {
        return $this->belongsTo('App\Wallet');
    }

    public function cryptocurrency()
    {
        return $this->belongsTo('App\Cryptocurrency');
    }
}
