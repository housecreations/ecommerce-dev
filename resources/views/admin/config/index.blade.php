@extends('admin.templates.admin')

@section('title', 'Configuración') 


@section('content') 
  
<div class="container">

    <div class='admin-container'>
 
        <div class="col-md-12 col-xs-12">
    
            <div class="admin-breadcrumb">
                <h2>Configuración</h2>
                <p>Gestione el funcionamiento de la aplicación</p>
            </div>

    
            <div class="admin-slider">


<div class="button-container">
<a href="{{ route('admin.index')}}" class="button button-sm">Atrás</a>
  

    
{!! Form::open(['route' => 'admin.config.status', 'method' => 'POST', 'id' => 'store-status-form']) !!}

<div class="form-group">
   
   
   @if($config->active == 'yes')
<button type="submit" class="button-on ">
Tienda activa
</button>
@else
<button type="submit" class="button-on button-off">
Tienda Inactiva
</button>
@endif
    
   
    
</div>

{!! Form::close() !!}
</div>
<hr>
 <div class="col-md-12">
 <h2>Envíos</h2>
  
     
     
     
     {!! Form::open(['route' => 'admin.shipment.store', 'method' => 'POST']) !!}
<div class="form-group">
{!! Form::label('name', 'Nombre de la empresa de envíos') !!}
{!! Form::text('name', null, ['class' => 'form-control', 'required', 'placeholder' => 'Nombre de la empresa de envíos']) !!}
</div>


<div class="form-group text-center">
    
    {!! Form::submit('Agregar empresa envíos', ['class' => 'cart-button'])!!}
    
</div>

{!! Form::close() !!}
     
     
     
  
  <table class="table table-hover">
      
      <thead>
          <tr>
              <th>Nombre empresa envíos</th>
              <th>Acciones</th>
          </tr>
      </thead>
      <tbody>
         @foreach($shipments as $shipment)
          <tr>
              <td>{{$shipment->name}}</td>
              <td><a href="{{ route('admin.shipment.edit', $shipment->id)}}" title="Editar" class='td-admin'><span class='fa-stack fa-lg ' aria-hidden='true'>
                     <i class="fa fa-square fa-stack-2x"></i>
  <i class="fa fa-wrench fa-stack-1x fa-inverse"></i>
                    </span></a>
               <a href="{{ route('admin.shipment.destroy', $shipment->id) }}" title="Eliminar" onclick="return confirm('Seguro que deseas eliminarlo?')" class='td-admin'><span class='fa-stack fa-lg ' aria-hidden='true'>
                     <i class="fa fa-square fa-stack-2x"></i>
  <i class="fa fa-times fa-stack-1x fa-inverse"></i>
                    </span></a></td>
          </tr>
          @endforeach
      </tbody>
      
  </table>
  <hr>
  </div>
   
   
   
   
    <div class="col-md-12">
    <h2>Cuentas bancarias</h2>
 <a href="{{ route('admin.payments_accounts.create')}}" class="button button-md">Nueva cuenta bancaria</a>  
    


  
  <table class="table table-hover">
      
      <thead>
          <tr>
              <th>Banco</th>
              <th>Tipo de cuenta</th>
              <th>Estado</th>
              <th>Acciones</th>
          </tr>
      </thead>
      <tbody>
         @foreach($payments_accounts as $payments_account)
          <tr>
              <td>{{$payments_account->bank_name}}</td>
              <td>{{$payments_account->bank_account_type}}</td>
              @if($payments_account->active == 'yes')
              <td>Activada</td>
              @else
              <td>Desactivada</td>
              @endif
              <td><a href="{{ route('admin.payments_accounts.edit', $payments_account->id)}}" title="Editar" class='td-admin'><span class='fa-stack fa-lg ' aria-hidden='true'>
                     <i class="fa fa-square fa-stack-2x"></i>
  <i class="fa fa-wrench fa-stack-1x fa-inverse"></i>
                    </span></a>
               <a href="{{ route('admin.payments_accounts.active', $payments_account->id) }}" title="Cambiar estado" onclick="return confirm('Seguro que deseas cambiar el estado de la cuenta?')" class='td-admin'><span class='fa-stack fa-lg ' aria-hidden='true'>
                     <i class="fa fa-square fa-stack-2x"></i>
  <i class="fa fa-toggle-on fa-stack-1x fa-inverse"></i>
                    </span></a></td>
          </tr>
          @endforeach
      </tbody>
      
  </table>
               <hr>
                </div>
   
   
   
   
   
   
   
   
   <div class="col-md-12">
    <h2>Correos de la aplicación</h2>
       
      {!! Form::open(['route' => 'admin.config.emails', 'method' => 'POST', 'id' => 'update-emails-form']) !!}



<div class="form-group">
{!! Form::label('sender_email', 'Cuenta para envío de correos de la aplicación') !!}
{!! Form::text('sender_email', $config->sender_email, ['class' => 'form-control', 'required', 'placeholder' => 'Desde aquí se enviarán los correos de tu aplicación']) !!}
</div>
<div class="form-group">
{!! Form::label('receiver_email', 'Cuenta para recepción de correos') !!}
{!! Form::text('receiver_email', $config->receiver_email, ['class' => 'form-control', 'required', 'placeholder' => 'Aquí se recibirán los correos de las ventas y los mensajes enviados']) !!}
</div>

<div class="form-group">
   
<button type="submit" class="button button-md">
Actualizar correos
</button>

    
</div> 
      {!! Form::close() !!}
       <hr>
   </div>
   
   <div class="col-md-12">
    <h2>Carritos de compra</h2>
       
      {!! Form::open(['url' => '/deleteNoUserCarts', 'method' => 'POST', 'id' => 'delete-carts-form']) !!}


<p>Carritos obsoletos: <span id='noUserCartsCount'>{{$noUserCartsCount}}</span></p>


<div class="form-group">
   
<button type="submit" class="button button-md">
Eliminar carritos obsoletos
</button>

    
</div> 
      {!! Form::close() !!}
       
   </div>
   
   <hr>
   
   
  
   
    </div>
    
    
   
    
    
    
</div>
 </div>
 </div>
 
  
   
   
@endsection