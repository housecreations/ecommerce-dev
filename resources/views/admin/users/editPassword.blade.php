@extends('admin.templates.admin')

@section('title', 'Panel de ' . Auth::user()->name) 


@section('content') 
  
<div class="container">

    <div class='admin-container'>
 
        <div class="col-md-12 col-xs-12">
    
            <div class="admin-breadcrumb">
                <h2>Cambiar contraseña</h2>
                <p>Actualice su contraseña</p>
            </div>

    
            <div class="admin-slider">

<a href="{{ route('member.index')}}" class="button button-sm">Atrás</a>
    <hr>

{!! Form::open(['route' => 'admin.password.update', 'method' => 'PUT']) !!}

<div class="form-group">
{!! Form::label('password', 'Contraseña actual') !!}
{!! Form::password('password', ['class' => 'form-control', 'required']) !!}

</div>
<div class="form-group">
{!! Form::label('new_password', 'Nueva contraseña') !!}
{!! Form::password('new_password', ['class' => 'form-control', 'required']) !!}
</div>
<div class="form-group">
{!! Form::label('confirm_password', 'Confirme contraseña') !!}
{!! Form::password('confirm_password', ['class' => 'form-control', 'required']) !!}
</div>





<div class="form-group text-center">
    
    {!! Form::submit('Cambiar contraseña', ['class' => 'cart-button'])!!}
    
</div>

{!! Form::close() !!}

    </div>
</div>
  
   
</div>
  </div>
  
   
@endsection