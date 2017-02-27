<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Order;
use App\Config;
use App\PaymentsAccount;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;
class MembersController extends Controller
{
   public function index(){
       
       if(Auth::user()->type == 'member'){
           
           
            
            
           
           //ordenes vencidas
           $orders = Auth::user()->shoppingCart->orders()->where('status', '=', 'No pagada')->get();
           
          foreach($orders as $order){
             
              if($order->created_at->diffInDays() >= 3){
                  
                  $order->status = 'Vencida';
                  $order->save();
                  
              }
              
          }
           
          $Orders = Auth::user()->shoppingCart->orders()->orderBy('id', 'DESC')->get();
           
           $currency = Config::find(1);
           $payments_accounts = PaymentsAccount::all();
           return view('admin.users.home', ['Orders' => $Orders, 'currency' => $currency->currency, 'payments_accounts' => $payments_accounts]);
           
       }else{
           
           return redirect('admin.index');
           
       }
       
       
   }
     public function editPassword(){
        
        return view('admin.member.editPassword');
    }
    public function updatePassword(Request $request){
        
        $user = Auth::user();
        
        if (\Hash::check($request->password, $user->password))
            {
    
            if($request->new_password == $request->confirm_password){
               $user->password = bcrypt($request->new_password);
                $user->save();
                Flash::success('La contraseña se cambió con éxito');
                return redirect()->route('member.index'); 
            }else{
               Flash::success('Las contraseñas no coinciden');
                return back(); 
            }
            
            }else{  
                Flash::success('Contraseña inválida');
                return back();
            }
        
        
         $Orders = Auth::user()->shoppingCart->orders()->get();
        return view('admin.users.home', ['Orders' => $Orders]);
    }
}
