@extends('admin.templates.admin')


@section('title', 'Editar usuario ' .$user->name )


@section('content')

 <div class="container">

    <div class='admin-container'>
 
        <div class="col-md-12 col-xs-12">
    
            <div class="admin-breadcrumb">
                <h2>Editar usuario</h2>
                <p>Haga cambios en los usuarios registrados</p>
            </div>

    
            <div class="admin-slider">

<a href="{{ route('admin.users.index')}}" class="button button-sm">Atrás</a>
    <hr>

{!! Form::open(['route' => ['admin.users.update', $user->id], 'method' => 'PUT']) !!}

<div class="form-group">
    
   {!! Form::label('name', 'Nombre') !!}
   {!! Form::text('name', $user->name, ['class' => 'form-control', 'placeholder' => 'Nombre y apellido', 'required']) !!}
    
</div>

<div class="form-group">
    
   {!! Form::label('email', 'Correo electrónico') !!}
   {!! Form::email('email', $user->email, ['class' => 'form-control', 'placeholder' => 'Sucorreo@dominio.com', 'required']) !!}
    
</div>



<div class="form-group">
    
    {!! Form::submit('Editar', ['class' => 'button'])!!}
    
</div>


{!! Form::close() !!}

    </div>
</div>
</div>
</div>
@endsection