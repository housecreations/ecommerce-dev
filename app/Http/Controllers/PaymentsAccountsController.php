<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\PaymentsAccount;

use Laracasts\Flash\Flash;

class PaymentsAccountsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.payments_accounts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $payment_account = new PaymentsAccount($request->all());
        $payment_account->save();
        
        Flash::success('Se ha agregado la cuenta con éxito');
        
        return redirect()->route('admin.config.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
  
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.payments_accounts.edit', ['payments_account' => PaymentsAccount::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       $payment_account = PaymentsAccount::find($id);
        $payment_account->fill($request->all());
        $payment_account->save();
        
        Flash::success('Se ha actualizado la cuenta con éxito');
        return redirect()->route('admin.config.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function active($id)
    {
       $payments_account = PaymentsAccount::find($id);
        
        if($payments_account->active == 'yes'){
            $payments_account->active = 'no';
            $payments_account->save();
        }else{
            $payments_account->active = 'yes';
            $payments_account->save();
        }
        
        Flash::success('Se ha cambiado el estado de la cuenta con éxito');
        return back();
    }
}
