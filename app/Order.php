<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\PaymentsAccount;

class Order extends Model
{
   protected $fillable = ['shopping_cart_id', 'customid', 'shipment_agency', 'shipment_agency_id', 'shipment_address', 'shipment_country', 'recipient_name', 'recipient_id', 'recipient_email', 'recipient_phone_number', 'payment_id', 'payment_type', 'payment_date', 'edited', 'status', 'guide_number', 'total', 'received'];
    
   public function scopeSearch($query, $name){
    
    return $query->where('payment_id', 'LIKE', "%$name%");
    
}
    
    
    public static function totalExpired(){
        
        return Order::where('status', '=', 'Vencida')->count();
        
    }
    
    public static function totalMonth(){
        
        if(Order::monthly()->sum('total'))
            return Order::monthly()->sum('total');
        else
            return 0;
    }
    
    public static function orderCount(){
        return Order::monthly()->where('status', '=', 'Por procesar')->count();
    }
    
    public static function orderCountAll(){
        return Order::where('status', '=', 'Por procesar')->count();
    }
    
    public static function totalMonthCount(){
        return Order::monthly()->count();
    }
    
    public function scopeLatest($query){
        
        return $query->orderID()->monthly();
            
    }
    
    public function scopeOrderID($query){
        
      
        return $query->orderBy('id', 'desc');
    }
    
    public function scopeMonthly($query){
         
        return $query->where('status', '!=', 'No pagada')->where('status', '!=', 'Vencida')->whereMonth('created_at', '=', date('m'));
    }
    
    
    public function shoppingCart(){
        
        return $this->belongsTo('App\ShoppingCart');
        
    }
    
    public function approve(){
        
        $this->status = 'No pagada';
        $this->customid = $this->generateCustomID();
        $this->save();
        
    }
    public function fail(){
        
        $this->updateCustomIDAndStatus('fail');
        
    }
   
    public function generateCustomID(){
        
        return md5("$this->id $this->updated_at");
    }
    
  
    
    public function orderDetails(){
        
        return $this->hasMany('App\OrderDetails');
        
    } 
    
    public function findPaymentsAccount($id){
        
        return PaymentsAccount::find($id);
    }
    
  
}
