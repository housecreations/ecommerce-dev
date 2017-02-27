@extends('admin.templates.principal')


@section('title', 'Checkout')


@section('content')
<div class="container">
<div class="items">

<ol class="breadcrumb bc text-center">
  <li><a href="/">Inicio</a></li>

    <li class="active">Checkout</li>
  <hr>
</ol>

<h1 class="text-left categories-title">Checkout</h1><span>Verifique bien los datos, una vez cargados no podrá modificarlos</span>
<h4>¡IMPORTANTE!</h4><span>Una vez realizado el pago en la plataforma MercadoPago, haga clic en 'continuar' para ser redireccionado de vuelta a la aplicación</span>



<hr>

{{--@if($order->edited == 'no')--}}

<div class="row">
<div class="col-md-6">

    

{!! Form::open(['url' => ['payments/pay'], 'method' => 'POST', 'id' => 'payments_form']) !!}

<h5 class="text-center">Información de envío</h5>

<div class="form-group">
    
   {!! Form::label('shipment_agency', 'Agencia de envío') !!}
   <select class="form-control" required="required" id="shipment_agency" name="shipment_agency"><option selected="selected" value="">Seleccione una agencia</option>
  
      
   
@foreach($shipments as $shipment)
                <option value="{{$shipment->name}}">{{$shipment->name}}</option> 
               
              @endforeach
              
           </select>
    
</div>

<div class="form-group">
    
   {!! Form::label('shipment_agency_id', 'Identificador de la agencia') !!}
   {!! Form::text('shipment_agency_id', '', ['class' => 'form-control', 'placeholder' => 'Zoom: Zoom Libertador | Mrw: 1600000', 'required']) !!}
    
</div>

<div class="form-group">
    
   {!! Form::label('payment_type', 'Método de pago') !!}
 <select class="form-control" required="required" id="payment_type" name="payment_type"><option selected="selected" value="">Seleccione un tipo de pago</option>
  
      <option value="TDC">Tarjeta de crédito</option> 
   
@foreach($payments_accounts as $payments_account)
               @if($payments_account->active == 'yes')
                <option value="{{$payments_account->id}}">{{$payments_account->bank_name}}</option> 
               @endif
              @endforeach
              
           </select>
    
</div>


<img class='payment-logo' src="/images/mercadopago.png" alt="">
<img class='payment-logo' src="/images/visa-master-logo.png" alt="">

</div>

<div class="col-md-6">
   
   <h5 class="text-center">Información del receptor</h5>
    
    <div class="form-group">
    
   {!! Form::label('recipient_name', 'Nombres') !!}
   {!! Form::text('recipient_name', '', ['class' => 'form-control', 'placeholder' => 'Nombre y apellido', 'required']) !!}
    
</div>
 <div class="form-group">
    
   {!! Form::label('recipient_id', 'Cédula de identidad') !!}
   {!! Form::number('recipient_id', '', ['class' => 'form-control', 'placeholder' => '1234567', 'required']) !!}
    
</div>


<div class="form-group">
    
   {!! Form::label('recipient_email', 'Correo electrónico') !!}
   {!! Form::email('recipient_email', '', ['class' => 'form-control', 'placeholder' => 'Sucorreo@dominio.com', 'required']) !!}
    
</div>


</div>
    
    
</div>
    <hr>
    
    <h1 class="text-left categories-title">Orden a pagar</h1>
    
    <div class="row">
    
        <div class="col-md-12">
        
            <table class="table table-condesed">
    
        <thead>
            <tr>
                <td class="cart-header">Detalle</td>
                
                <td class="cart-header">Monto</td>
                
            </tr>
        </thead>
        
        <tbody class="cart-tbody">
            
            
             @foreach($articles as $article)
            <tr class="text-center">
                
                <td class="cart-name"><a class="a-no-style" href="/articulos/{{$article->category->slug}}/{{$article->slug}}">{{$article->name}}</a></td>
                <td class="cart-price">{{$article->price_now}} {{$currency}}</td>
                
                                    
            </tr>
            
            @endforeach
            
            
             <tr class="text-center">
                <td class="cart-price" id="comision">Comisión plataforma de pagos </td>
              
                <td class="cart-price" id="comision-price">0 Bs</td>
                
            </tr>
            <tr class="text-center">
                <td class="cart-total">Total</td>
              
                <td class="cart-price" id="total-price">0 Bs</td>
                <td class="hidden" id="total-amount">{{$total}}</td>
            </tr>
            
            
                </tbody>
            </table>
            
        
        </div>
    
    </div>
    
    
<hr>
@if($active->active == 'no')
<h3 class="text-center bottom-space-md">Lo sentimos, los pagos están desactivados</h3>
@else
<div class="form-group col-md-6">
    
    {!! Form::submit('Pagar', ['class' => 'cart-button'])!!}
    
</div>
@endif
  <div class=" col-md-6">  
<a href="{{ url('/carrito')}}" class="button">Atrás</a>
</div>

{!! Form::close() !!}
</div>
</div>

@endsection