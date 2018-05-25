<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Client;

class Client extends Model
{
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function orders() 
    {
    	return $this->belongsToMany(Order::class, 'orders_clients','client_id', 'order_id')
            ->with('user');
    }
}
