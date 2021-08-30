<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'wallet';
    protected $fillable = ['available_money', 'address'];
    public $timestamps = false;

    public function user()
    {
        return $this->hasOne('App\User');
    }

    public function ownedCrypto(){
        return $this->hasMany('App\OwnedCrypto');
    }
}
