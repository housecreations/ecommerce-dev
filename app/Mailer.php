<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Mail;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Config;

class Mailer extends Model
{
    public static function sendAdminEmail($order){
      $config = Config::find(1);
             
               
                $link_url = url('/admin/orders/all?name='.$order->payment_id);
                $array = [
                   
                    
                    "order" => $order,
                   
                    "link_url" => $link_url
                    ];
                
                $data = $array;
                 Mail::queue('emails.admin-notification', $data, function($messagee) use ($order, $config)
                {
                //remitente
                $messagee->from($config->sender_email, $config->sender_name);
 
                //asunto
                $messagee->subject("Se ha realizado una compra");
 
                //receptor
                $messagee->to($config->receiver_email, '');
 
                });  
        
    }
    
    public static function processEmail($order){
        
        $config = Config::find(1);
             
                $url = url('/images/email/email-banner.jpg');
                $button_url = url('/home');
                $array = [
                   
                    
                    "order" => $order,
                    "url" => $url,
                    "button_url" => $button_url
                    ];
                
                $data = $array;
                 Mail::queue('emails.user-process-notification', $data, function($messagee) use ($order, $config)
                {
                //remitente
                $messagee->from($config->sender_email, $config->sender_name);
 
                //asunto
                $messagee->subject("Su orden se encuentra en proceso de verificación");
 
                //receptor
                $messagee->to($order->shoppingCart->user->email, $order->shoppingCart->user->name );
 
                });
        
        
    }
    
    public static function sendEmail($order){
        
        $config = Config::find(1);
             
                $url = url('/images/email/email-banner.jpg');
                
                $array = [
                   
                    
                    "order" => $order,
                    "currency" => $config->currency,
                    "url" => $url
                    ];
                
                $data = $array;
                 Mail::queue('emails.user-send-notification', $data, function($messagee) use ($order, $config)
                {
                //remitente
                $messagee->from($config->sender_email, $config->sender_name);
 
                //asunto
                $messagee->subject("Su compra fue enviada");
 
                //receptor
                $messagee->to($order->shoppingCart->user->email, $order->shoppingCart->user->name );
 
                });
        
    }
    
    public static function sendMessageEmail($request, $data){
        
        $config = Config::find(1);
            
 
         //se envia el array y la vista lo recibe en llaves individuales {{ $email }} , {{ $subject }}...
               Mail::send('emails.admin-messages', $data, function($messagee) use ($request, $config)
                {
                //remitente
                $messagee->from($config->sender_email, $config->sender_name);
 
                //asunto
                $messagee->subject($request->subject);
 
                //receptor
                $messagee->to($config->receiver_email, '');
 
                }); 
        
    }
}
