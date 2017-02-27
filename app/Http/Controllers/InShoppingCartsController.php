<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\ShoppingCart;
use App\Article;
use App\InShoppingCart;
use Illuminate\Support\Facades\Auth;


class InShoppingCartsController extends Controller
{
   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         if(Auth::user()){
                
                    $shopping_cart = Auth::user()->shoppingCart;
                    $response = InShoppingCart::create([
                                    'shopping_cart_id' => $shopping_cart->id,
                                    'article_id' => $request->article_id]);
                    
                    if($request->ajax()){
                        
                        return response()->json([
                            'products_count' => InShoppingCart::productsCount($shopping_cart->id)
                        ]);
                        
                    }
                
                    if($response){
                    
                        return redirect('/carrito');
                    
                    }else{
                        
                        return back();
                    
                    }
               
             
         }else{
               
                    $shopping_cart_id = \Session::get('shopping_cart_id');
                    $shopping_cart = ShoppingCart::findOrCreateBySessionID($shopping_cart_id);
                    $response = InShoppingCart::create([
                            'shopping_cart_id' => $shopping_cart->id,
                            'article_id' => $request->article_id]);
                    
             
                    if($request->ajax()){
                        
                        return response()->json([
                            'products_count' => InShoppingCart::productsCount($shopping_cart->id)
                        ]);
                        
                    }
             
                    if($response){
                        
                        return redirect('/carrito');
                    
                    }else{
                        
                        return back();
                    
                    }
              
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
    
        if(Auth::user()){  
            
            $shopping_cart = Auth::user()->shoppingCart;
            $shopping_cart->articles()->where('article_id', $request->article_id)->wherePivot('id', $id)->detach($request->article_id);
            return back();
            
        }else{
            $shopping_cart_id = \Session::get('shopping_cart_id');
            $shopping_cart = ShoppingCart::findOrCreateBySessionID($shopping_cart_id);
            $shopping_cart->articles()->where('article_id', $request->article_id)->wherePivot('id', $id)->detach($request->article_id);
            return back();
            
        }
       
    }
}
