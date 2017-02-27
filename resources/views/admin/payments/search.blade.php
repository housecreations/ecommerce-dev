@extends('admin.templates.admin')

@section('title', 'Buscar pago') 


@section('content') 
  
  
<div class="container">

    <div class='admin-container'>
 
        <div class="col-md-12 col-xs-12">
    
            <div class="admin-breadcrumb">
                <h2>Buscar pagos</h2>
                <p>Busque un pago que por alguna razón no haya sido procesado correctamente</p>
            </div>

    
            <div class="admin-slider">

<a href="{{ route('admin.index')}}" class="button button-sm">Atrás</a>
    <hr>
    
    

{!! Form::open(['route' => 'admin.payments.search', 'method' => 'POST']) !!}

<div class="form-group">
{!! Form::label('payment_id', 'Número de pago') !!}
{!! Form::number('payment_id', null, ['class' => 'form-control', 'required']) !!}

</div>

<div class="form-group text-center">
    
    {!! Form::submit('Buscar pago', ['class' => 'cart-button'])!!}
    
</div>

{!! Form::close() !!}

    </div>
</div>
    </div>
</div>
   
   
@endsection