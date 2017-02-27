@extends('admin.templates.principal')

@section('title', 'Panel de ' . Auth::user()->name) 


@section('content') 
  
  <div class="container">
<div class="items">    

<div class="col-md-7 col-md-offset-3 col-sm-7 col-sm-offset-3 col-xs-10 col-xs-offset-1">

<a href="{{ route('member.index')}}" class="button button-sm">Atrás</a>
    <hr>

{!! Form::open(['route' => 'member.password.update', 'method' => 'PUT']) !!}

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
   
   
@endsection