<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Message;
use App\Category;
use Laracasts\Flash\Flash;
use Mail;
use GuzzleHttp\Client;
use Carbon\Carbon;
use App\Mailer;


class MessagesController extends Controller
{
   
    public function __construct(){
        
        Carbon::setLocale('es');
    }
    
    public function api(){
        
          $client = new Client();
           
          
            
            $response = $client->post('localhost:8000/v1/test', [
                'form_params' => [
                'token' => '123456',
                'var2' => 'val2'
                ]
            ]);
        
        dd($response->getBody()->getContents());
        
    }
    
     public function index(Request $request)
    {
   
        
         $messages = Message::orderBy('id', 'DESC')->paginate(10);
         
        return view('admin.messages.index')->with('messages', $messages);
    }
 
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
   
 
    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {   
         
         if($request->ajax()){
               $token = $request->input("g-recaptcha-response");
            
              $client = new Client();
           
          
            
            $response = $client->post('https://www.google.com/recaptcha/api/siteverify', [
                'form_params' => [
                'secret' => env('RE_CAP_SECRET'),
                'response' => $token
                ]
            ]);
           
            
            $result = json_decode($response->getBody()->getContents());
             
            if($result->success){
                
                $message = new Message($request->all());
                $message->message = $request->body;
                $message->save();
        
                $data = $request->all();
            
                Mailer::sendMessageEmail($request, $data);
        
                return response()->json(['status' => 'success']);
         
            }else{
                
                return response()->json(['status' => 'fail']);
            
            }
        
         }
       
  
    }
 
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        
        $message = Message::find($id);
        $message->read = 'yes';
        $message->save();
        $categories = Category::all();
        
        return view('admin.messages.show')->with('message', $message);
    }
 
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
  
    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
       
        $message = Message::destroy($id);
      
        
        Flash::success('El mensaje ha sido eliminado');
        
        return redirect()->route('admin.messages.index');
    }
    
    
    
    
}
