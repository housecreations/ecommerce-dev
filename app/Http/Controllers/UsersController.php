<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\ShoppingCart;
use Laracasts\Flash\Flash;
use App\Http\Requests\UserRequest;
use App\Category;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        
       $users = User::search($request->name)->orderBy('id', 'DESC')->paginate(5);
      
        return view('admin.users.index')->with('users', $users);
    }
 
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
       
        return view('admin.users.create');
        
    }
 
    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(UserRequest $request)
    {
    
        
       
      /*  if($request->type == 'member'){*/
          
        $shopping_cart_id = \Session::get('shopping_cart_id');
        
        
        
        $user = User::where('shopping_cart_id', '=', $shopping_cart_id)->get();
        
        if(!count($user) == 0)
            $shopping_cart = ShoppingCart::createWithoutSession();
            else
            $shopping_cart = ShoppingCart::findBySession($shopping_cart_id);
      
        
      /*  $shopping_cart = ShoppingCart::findOrCreateBySessionID($shopping_cart_id);*/
        
        User::create([
            'name' => $request->name,
            'lastname' => $request->lastname,
            'shopping_cart_id' => $shopping_cart->id,
            'email' => $request->email,
            'type' => $request->type,
            'password' => bcrypt($request->password),
        ]);
        /*}else{
            dd('hola');
            $user = new User($request->all());
            $user->password = bcrypt($request->password);
            $user->save();
        }*/
        
        Flash::success("Se ha registrado de forma existosa");
        
      
        
        return redirect()->route('admin.users.index');
        
    }
 
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        
        
    }
 
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
      $user = User::find($id);
        
       
        return view('admin.users.edit')->with('user', $user);
    }
 
    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
       
       $user = User::find($id);
        $user->fill($request->all());
      
        
        $user->save();
        
        Flash::success('El usuario se editó con éxito');
        
       
            return redirect()->route('admin.users.index');
    }
 
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        
        Flash::success('El usuario ' . $user->name. ' ha sido eliminado');
      
        return redirect()->route('admin.users.index');
    }
    
     public function editPassword(){
        
        return view('admin.users.editPassword');
    }
     public function updatePassword(Request $request){
        
        $user = Auth::user();
        
        if (\Hash::check($request->password, $user->password))
            {
    
            if($request->new_password == $request->confirm_password){
               $user->password = bcrypt($request->new_password);
                $user->save();
                Flash::success('La contraseña se cambió con éxito');
                return redirect()->route('admin.index'); 
            }else{
               Flash::success('Las contraseñas no coinciden');
                return back(); 
            }
            
            }else{  
                Flash::success('Contraseña inválida');
                return back();
            }
        
        
       
        return redirect()->route('admin.index');
    }
}
