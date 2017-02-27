@extends('admin.templates.admin')


@section('title', 'Crear usuario')


@section('content')

 <div class="container">

    <div class='admin-container'>
 
        <div class="col-md-12 col-xs-12">
    
            <div class="admin-breadcrumb">
                <h2>Registrar usuario</h2>
                <p>Puede crear nuevos miembros o administradores de la aplicación</p>
            </div>

    
            <div class="admin-slider">

<a href="{{ route('admin.users.index')}}" class="button button-sm">Atrás</a>
    <hr>

{!! Form::open(['route' => 'admin.users.store', 'method' => 'POST']) !!}

<div class="form-group">
    
   {!! Form::label('name', 'Nombre') !!}
   {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nombre', 'required']) !!}
    
</div>

<div class="form-group">
    
   {!! Form::label('lastname', 'Apellido') !!}
   {!! Form::text('lastname', null, ['class' => 'form-control', 'placeholder' => 'Apellido', 'required']) !!}
    
</div>

<div class="form-group">
    
   {!! Form::label('email', 'Correo electrónico') !!}
   {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Sucorreo@dominio.com', 'required']) !!}
    
</div>

<div class="form-group">
    
   {!! Form::label('type', 'Tipo') !!}
   {!! Form::select('type', ['admin' => 'Administrador', 'member' => 'Miembro'],null, ['class' => 'form-control', 'placeholder' => 'Tipo usuario', 'required']) !!}
    
</div>

<div class="form-group">
    
   {!! Form::label('password', 'Contraseña') !!}
   {!! Form::password('password', ['class' => 'form-control', 'placeholder' => '**********', 'required']) !!}
    
</div>

<!--<div class="form-group">
    {!! Form::label('type', 'Tipo') !!}
    {!! Form::select('type', ['member' => 'Miembro', 'admin' => 'Administrador'], null, ['class'=> 'form-control', 'placeholder' => 'Seleccione un tipo de usuario', 'required'] ) !!}
    
</div>
-->
<div class="form-group text-center">
    
    {!! Form::submit('Registrar', ['class' => 'button'])!!}
    
</div>


{!! Form::close() !!}
     </div>
     </div>
      </div>
     </div>
@endsection