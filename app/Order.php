<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'orders';
    protected $fillable = ['type', 'price', 'quantity', 'cryptocurrency_id', 'user_id'];
    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function cryptocurrency()
    {
        return $this->belongsTo('App\Cryptocurrency');
    }
}
