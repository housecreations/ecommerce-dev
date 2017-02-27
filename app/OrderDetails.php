<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
     protected $fillable = ['order_id', 'name', 'price'];
    
    
   
    
    public function order(){
        
        return $this->belongsTo('App\Order');
        
    } 
}
