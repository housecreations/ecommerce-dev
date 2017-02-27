<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use JPBlancoDB\MercadoPago\MercadoPago;
use App\ShoppingCart;
use App\Order;
use App\Message;
use App\OrderDetails;
use App\InShoppingCart;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;
use Mail;
use App\Mailer;
use App\Shipment;
use App\Config;
use App\PaymentsAccount;

use Carbon\Carbon;
	
use Illuminate\Support\Collection as Collection;

class PaymentsController extends Controller
{   
    
    
    public function search(Request $request){
        
        try{
            $className = 'JPBlancoDB\MercadoPago\MercadoPago';
        
            if (!class_exists($className)) {
                throw new \Exception('The class '.$className.' does not exist.');
            }
            
            
        $paymentInfo = MercadoPago::get_payment($request->payment_id);
        }catch(\Exception $err){
            if($err->getCode() == '404'){
                Flash::success('No hemos podido encontrar el pago');
                return back();
            }
            return abort(500);
            
        }
        
        
        if($paymentInfo['response']['collection']['status'] != 'approved'){
 Flash::success('El pago no está aprobado');
return back();
}
        
        
        $order = Order::where('customid',$paymentInfo['response']['collection']['order_id'])->first();
     
        if($order){
            if($order->status == 'No pagada'){
                    $order->status = "Por procesar";
                    $order->received = "yes";
                    $order->payment_id = $request->payment_id;
                    $order->save();
                    
                    //Email al usuario
                    Mailer::processEmail($order);
        
                
                    //Email al administrador  
                    Mailer::sendAdminEmail($order);
                    
                    Flash::success('Se ha encontrado el pago #'.$order->payment_id);
                    return redirect('admin/orders/all?name='.$order->payment_id);
                
             }else{
              
                Flash::success('El pago ya está en la base de datos');
                return back();
            }     
            }
        
    }
    
     public function searchView(Request $request){
        
        return view('admin.payments.search');
        
    }
    
    
    public function checkout(){
        
        
            $shopping_cart = Auth::user()->shoppingCart;
            $articles = $shopping_cart->articles()->get();
        $currency = Config::find(1);
        $total = $shopping_cart->total();
        
       return view('orders.checkout', ['shipments' => Shipment::all(), 'active' => Config::all()->first(), 'payments_accounts' => PaymentsAccount::all(), 'articles' => $articles,'currency' => $currency->currency, 'total' => $total]);
        
    }
    
    public function index(Request $request){
      
        

        
        
        //obtener carrito
        $shoppingCart = Auth::user()->shoppingCart;
        
        
        if($shoppingCart->articles()->count() == 0){
            Flash::success('No hay artículos en el carrito');
            return back();
        }
        
        //array con los items
        $items = [];
        $config = Config::find(1);
        foreach ($shoppingCart->articles as $article){
            
         
            $articlesCount = $shoppingCart->articles()->where("article_id", "=", $article->id)->groupBy("article_id")->count(); //saber cuantos items son sin repetirse
          
            if($article->stock >= $articlesCount){ //verificar que haya existencia
                
                $item = array_add([
                        "title" => 'Carrito de compras',
                        "currency_id" => $config->currency_code,
                        "category_id" => $article->category->name,
                        "quantity" => 1],
                    'unit_price', floatval($article->price_now));

                array_push($items, $item);
            
            }else{
                
                
                Flash::success('No hay suficiente disponibilidad del artículo '. $article->name);
                return back();
                
            }
        }
   
        
        
        $baseURL = url('/');
        
        $order = Order::create([
           
            'shopping_cart_id' => $shoppingCart->id,
            'total' => $shoppingCart->total()
            
            
        ]);

       foreach ($shoppingCart->articles as $article){
        
       $orderDetails = OrderDetails::create([
           
            'order_id' => $order->id,
            'name' => $article->name,
            'price' => $article->price_now
            
        ]);
           }
        
       
        
        $order->approve();
        
        $external_reference = $order->customid;
        
        $preference_data = array(
        "items" => $items,
        "back_urls" => array (
           
                "success" => "$baseURL/payments/success",
		        "failure" => "$baseURL/payments/fail",
		        "pending" => "$baseURL/payments/pending"
	
        ),
            
             "external_reference" => $external_reference,
             
            "payment_methods" => array (
            "excluded_payment_methods" => array (),
            "excluded_payment_types" => array (
                array ( "id" => "ticket" ),
                array ( "id" => "atm" ),
                array ( "id" => "debit_card" ),
                array ( "id" => "prepaid_card" ),
            ),
            "installments" => 12
        )


    );



    //orden
        
        /*$order = Auth::user()->shoppingCart->orders()->where('customid', '=', $request->orders)->first();*/
        $order->shipment_agency = $request->shipment_agency;
        $order->shipment_agency_id = $request->shipment_agency_id;
        $order->recipient_name = $request->recipient_name;
        $order->recipient_id = $request->recipient_id;
        $order->recipient_email = $request->recipient_email;
        $order->payment_type = $request->payment_type;
       /* $order->edited = 'yes';*/
        $order->save();
      
      
        try {
            
              $className = 'JPBlancoDB\MercadoPago\MercadoPago';
        
            if (!class_exists($className)) {
                throw new \Exception('The class '.$className.' does not exist.');
            }
          
                
                
            $preference = MercadoPago::create_preference($preference_data);
            return redirect()->to($preference['response']['init_point']);
        
        
        } catch (\Exception $e){
            $order->delete();
             return abort(500);
        }
        
        
        
        
        
        
        
     
        
        
        
        
    }
    
    public function pay_bank(Request $request){
        
        
        
        //obtener carrito
        $shoppingCart = Auth::user()->shoppingCart;
        
        
        if($shoppingCart->articles()->count() == 0){
            Flash::success('No hay artículos en el carrito');
            return back();
        }
        
  
      
        $config = Config::find(1);
        foreach ($shoppingCart->articles as $article){
            
         
            $articlesCount = $shoppingCart->articles()->where("article_id", "=", $article->id)->groupBy("article_id")->count(); //saber cuantos items son sin repetirse
          
            if($article->stock >= $articlesCount){ //verificar que haya existencia
          
            }else{
                
                
                Flash::success('No hay suficiente disponibilidad del artículo '. $article->name);
                return back();
                
            }
        }
   
        
        
       
        
        $order = Order::create([
           
            'shopping_cart_id' => $shoppingCart->id,
            'total' => $shoppingCart->total()
            
            
        ]);

       foreach ($shoppingCart->articles as $article){
        
       $orderDetails = OrderDetails::create([
           
            'order_id' => $order->id,
            'name' => $article->name,
            'price' => $article->price_now
            
        ]);
           }
        
       
        
   
        
    //orden
        
      
        $order->shipment_agency = $request->shipment_agency;
        $order->shipment_agency_id = $request->shipment_agency_id;
        $order->recipient_name = $request->recipient_name;
        $order->recipient_id = $request->recipient_id;
        $order->recipient_email = $request->recipient_email;
        $order->payment_type = $request->payment_type;
       
        $order->status = 'No pagada';
        $order->received = "yes";
        $order->save();
        
        //restar artículos vendidos
        foreach($shoppingCart->articles as $article){
                        
                        $article->stock = $article->stock - 1;
                        $article->save();
                   
                        
                    }
        //vaciar carrito
        $shoppingCart->articles()->detach();
        
        
         Flash::success('La orden fue creada, cuando cargue el número identificador del pago su orden será procesada para envío');
        return redirect('/home');
        
        
        
    }
    
    public function pay_bank_data(Request $request, $id){
        
        
        $date = Carbon::createFromFormat('Y-m-d', $request->payment_date)->format('d/m/Y');
        
        $order = Order::find($id);
        $order->payment_id = $request->payment_number;
        $order->payment_date = $date;
        $order->status = 'Por procesar';
        $order->save();
        
        Mailer::processEmail($order);
        Mailer::sendAdminEmail($order);
        
        Flash::success('Se han cargado los datos de su pago');
        return back();
        
    }
    
    public function fail(Request $request){
        
       
        Order::where('customid', $request->external_reference)->delete();
      
        
         Flash::success('No se pudo procesar el pago, por favor intente nuevamente');
        
        return redirect('/checkout');
        
        
        
    }
    
    
 
public function pending(Request $request){

$paymentInfo = MercadoPago::get_payment($request->collection_id);



if($paymentInfo['response']['collection']['status'] == 'rejected'){

 Flash::success('El pago fue rechazado, por favor intente nuevamente');
        
  return redirect('/checkout');

}elseif($paymentInfo['response']['collection']['status'] == 'in_process'){

 Flash::success('Pago en proceso, envíe el número de pago al recibirlo');
        
  return redirect('/home');


}else{

 Flash::success('Pago pendiente, envíe el número de pago al recibirlo');
        
  return redirect('/home');

}

}
    
    
     public function success(Request $request){
        
        
        $paymentInfo = MercadoPago::get_payment($request->collection_id);
      

         //Si el order_id de la respuesta de MP es igual al de la url
        if($paymentInfo['response']['collection']['order_id'] == $request->external_reference){ 
         
         
         $order = Order::where('customid', $request->external_reference)->first();
       
         if($order){
             
                if($order->received == "no"){
                    
                    $order->status = 'Por procesar';
                    $order->received = "yes";
                    $order->payment_id = $request->collection_id;
                    $order->save();
                    
                    $shopping_cart = $order->shoppingCart;
                  /*  $shopping_cart = Auth::user()->shoppingCart;
                */    
                    
                   //restar artículos vendidos
                    foreach($shopping_cart->articles as $article){
                        
                        $article->stock = $article->stock - 1;
                        $article->save();
                   
                        
                    }
                    //vaciar carrito
                    $shopping_cart->articles()->detach();
                    
                
                    
                   
                     //Email al usuario
                    Mailer::processEmail($order);
        
                
                    //Email al administrador  
                    Mailer::sendAdminEmail($order);
                    
                    
                    
                
                }
             Flash::success('El pago fue exitoso, su orden se encuentra en proceso de verificación');
                return redirect('/home');
                
         }else{
             
                Flash::success('Error, la orden no corresponde a ninguna registrada en nuestra base de datos');
                return redirect('/home');
         
         }
     }else{
            
            Flash::success('Error en la orden');
             return redirect('/home');
        
        }
        
    }
    
}
