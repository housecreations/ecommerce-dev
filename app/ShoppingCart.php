<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model
{
    protected $fillable = ['status'];
    
    
    public static function noUserCartsCount(){
        
        $shoppingCarts = ShoppingCart::all();
        $count = 0;
        foreach($shoppingCarts as $shoppingCart){
            
            if(!$shoppingCart->user)
                $count += 1;
            
        
        }
        
        return $count;
        
    }
    
    public function orders(){
        
        return $this->hasMany('App\Order');
        
    }
    
    public function approve(){
        
        $this->updateCustomIDAndStatus();
        
    }
   
    public function generateCustomID(){
        
        return md5("$this->id $this->updated_at");
    }
    
    public function updateCustomIDAndStatus(){
        $this->status = 'aprobado';
        $this->customid = $this->generateCustomID();
        $this->save();
    }
    
    public function user(){
        
        return $this->hasOne('App\User');
    } 
    
    public function inShoppingCarts(){
        
        return $this->hasMany('App\InShoppingCart');
        
    }
    
    public function articles(){
        
        return $this->belongsToMany('App\Article','in_shopping_carts')->withPivot('id');
        
    }
    
    
    public function products_size(){
        
        return $this->articles()->count();
        
    }
    
    public function total(){
        
        return $this->articles()->sum('price_now');
    }
    
    
    public static function findOrCreateBySessionID($shopping_cart_id){
        
        if($shopping_cart_id){
           
            return ShoppingCart::findBySession($shopping_cart_id);
        }else{
           
            return ShoppingCart::createWithoutSession();
        }
    }
    
    public static function findBySession($shopping_cart_id){
       
        return ShoppingCart::find($shopping_cart_id);
        
    }
    
    public static function createWithoutSession(){
        
       
        
        return ShoppingCart::create([
           
            "status" => "incompleted"
            
        ]);
        
    }
}
