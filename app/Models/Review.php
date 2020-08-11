<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    public function user(){
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function exchange(){
        return $this->belongsTo('App\Models\Exchange', 'exchange_id', 'id');
    }

    public function coin(){
        return $this->belongsTo('App\Models\Coin', 'coin_id', 'id');
    }
}
