@extends('admin.templates.principal')

@section('title', 'Panel de ' . Auth::user()->name) 


@section('content') 
  
  
<div class="container">
   <div class="items">
   
    <div class="col-md-12 col-sm-12 col-xs-12 user-nav">
   <div class="col-md-6 col-sm-6 col-xs-6">
   <h3>Mis compras</h3>
   </div>
   
    <div class="col-md-6 col-sm-6 col-xs-12">
    <a href="{{route('member.password.edit')}}" class="button button-lg float-right">Cambiar contraseña</a>
   </div>
   </div>
   
   
   @if(count($Orders) == 0)
   <hr>
   <h5 class="text-center">No ha realizado compras</h5>
    </div>
   
   @else
   
   @foreach($Orders as $order)
   <hr>
   <div class="row order-data">
     <div class="col-md-6">
       <h5 class="order-status {{$order->status}}">Estado: {{$order->status}}</h5>
       </div>
      <div class="col-md-6 text-right">
       <h5>Compra #{{$order->payment_id}}</h5><h5> Fecha: {{$order->created_at->format('d/m/Y')}}</h5>
       </div>
   
       <div class="col-md-6">
       <table class='table'>
           <thead>
        <th>Artículo</th>
        <th>Precio</th>
        
    </thead>
      <tbody>
         @foreach($order->orderDetails as $orderDetail)
          <tr>
              <td>{{$orderDetail->name}}</td>
              <td>{{$orderDetail->price}} {{$currency}}</td>
          </tr>
        @endforeach
          <tr>
                <td>Total</td>
                <td>{{$order->total}} {{$currency}}</td>
            </tr>
      </tbody>
       </table>
       </div>
       <div class="col-md-6">
           <h5 class="text-center">Información de envío</h5>
           <h5>Agencia de envío: {{$order->shipment_agency}}</h5>
           <h5>Identificador de agencia: {{$order->shipment_agency_id}}</h5>
           <h5>Número de guía: {{$order->guide_number}}</h5>
           @if($order->status == "Enviado")
           <h5>Fecha de envío: {{$order->updated_at->format('d/m/Y')}}</h5>
           @endif
           <hr>
           <h5 class="text-center">Información del receptor</h5>
           <h5>Nombres: {{$order->recipient_name}}</h5>
           <h5>C.I:{{$order->recipient_id}}</h5>
           <h5>Correo Electrónico: {{$order->recipient_email}}</h5>
       </div>
       
       @if($order->payment_type != 'TDC')
       @if($order->findPaymentsAccount($order->payment_type)->bank_name)
       <div class="col-md-6">
          <hr>
           <h5 class="text-center">Información de pago</h5>
           <h5>Banco: {{$order->findPaymentsAccount($order->payment_type)->bank_name}}</h5>
           <h5>Tipo de cuenta: {{$order->findPaymentsAccount($order->payment_type)->bank_account_type}}</h5>
           <h5>Número de cuenta: {{$order->findPaymentsAccount($order->payment_type)->bank_account_number}}</h5>
           <h5>Titular: {{$order->findPaymentsAccount($order->payment_type)->owner_name}}</h5>
           <h5>C.I/RIF: {{$order->findPaymentsAccount($order->payment_type)->owner_id}}</h5>
           <h5>Correo: {{$order->findPaymentsAccount($order->payment_type)->owner_email}}</h5>
       </div>
       <div class="col-md-6">
          <hr>
           <h5 class="text-center">Datos del pago</h5>
           @if($order->status == 'No pagada')
           
           
           
             @if($order->findPaymentsAccount($order->payment_type)->active == 'yes')
             
           {!! Form::open(['url' => ['payments/pay_bank/data/'.$order->id], 'method' => 'POST', 'id' => 'pay_bank_data_'.$order->id]) !!}
           
            <div class="form-group">
    
   {!! Form::label('payment_number', 'Número transferencia o depósito') !!}
   {!! Form::number('payment_number', $order->payment_id, ['class' => 'form-control', 'placeholder' => '', 'required']) !!}
    
</div>
           
            <div class="form-group">
    
   {!! Form::label('payment_date', 'Fecha del pago') !!}
   {!! Form::date('payment_date', $order->payment_date, ['class' => 'form-control', 'required']) !!}
    
</div>
           
         
            <div class="form-group">
           {!! Form::submit('Cargar datos', ['class' => 'cart-button'])!!}
           </div>
           {!! Form::close() !!}
           
           @else
           <h5>La cuenta está desactivada para realizar pagos</h5>
           @endif
           
           
           
           
           
           
           
           @else
           
           
           <h5>Número transferencia o depósito: {{$order->payment_id}}</h5>
           <h5>Fecha de pago: {{$order->payment_date}}</h5>
           
           
           @endif
       </div>
       @endif
       @endif
       
   </div>
   
  @endforeach
   
   @endif
   
</div>
   </div>
@endsection