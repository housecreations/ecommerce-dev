<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'lastname', 'email', 'password','shopping_cart_id', 'type',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


  public function shoppingCart(){
        
        return $this->belongsTo('App\ShoppingCart');
    } 

public function scopeSearch($query, $name){
    
    return $query->where('email', 'LIKE', "%$name%");
    
}

}





