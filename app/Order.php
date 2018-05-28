<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id_fk', 'id');
    }
    public function client() 
    {
    	return $this->belongsTo(Client::class, 'client_id_fk', 'id');    
    }
    public function products() 
    {
    	return $this->belongsToMany(Product::class)->withPivot('user_id', 'client_id', 'quantity', 'price');;
    }

}
