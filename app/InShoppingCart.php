<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InShoppingCart extends Model
{
    protected $fillable = ['article_id', 'shopping_cart_id', 'quantity'];
    
    public static function productsCount($shopping_cart_id){
        return InShoppingCart::where("shopping_cart_id", $shopping_cart_id)->sum('quantity');
    }
}
