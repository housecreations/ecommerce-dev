@extends('admin.templates.principal')


@section('title', 'Login')

@section('content')



<div class="container">

 <div class="items login">    

<div class="col-md-4 col-sm-8 col-md-offset-4 col-sm-offset-2">
{!! Form::open(['route' => 'admin.auth.login', 'method' => 'POST']) !!}
<div class="form-group">

 {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Correo Electrónico', 'autofocus']) !!}
</div>

<div class="form-group">

 {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Contraseña']) !!}
</div>

<div class="form-group text-center">
 {!! Form::submit('Ingresar', ['class' => 'cart-button']) !!}
 
</div>

{!! Form::close() !!}
    <hr>
    <div class="col-md-12">
        <a href="{{route('admin.auth.register')}}" class="pull-left">Registrarse</a>
        <a href="{{ url('/password/reset') }}" class="pull-right">¿Olvidaste tu contraseña?</a>

    </div>
    
    
   
     </div>
</div>
</div>
@endsection
