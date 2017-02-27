<?php

namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use App\ShoppingCart;
use Illuminate\Support\Facades\Auth;

class ShoppingCartComposer{
    
    public function compose(View $view){
        
       
        
       if(Auth::user()){
         
           
           $shopping_cart = Auth::user()->shoppingCart;
           
           $view->with('productsCount', $shopping_cart->products_size());
           
       }
        else{
        try{
        $shopping_cart_id = \Session::get('shopping_cart_id');
        
        $shopping_cart = ShoppingCart::findOrCreateBySessionID($shopping_cart_id);
        
            
            
        \Session::put('shopping_cart_id', $shopping_cart->id);
        
        $view->with('productsCount', $shopping_cart->products_size());
            
        
        }catch(\ErrorException $err){
            
            $shopping_cart = ShoppingCart::create([
           
            "status" => "incompleted"
            
        ]);
            
             \Session::put('shopping_cart_id', $shopping_cart->id);
        
        $view->with('productsCount', $shopping_cart->products_size());
            
        }
            }
        
    }
    
}