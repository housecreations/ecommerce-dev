@extends('admin.templates.admin')


@section('title', 'Editar empresa envíos')


@section('content')
<div class="container">

    <div class='admin-container'>
 
        <div class="col-md-12 col-xs-12">
    
            <div class="admin-breadcrumb">
                <h2>Editar empresa</h2>
                <p>Cambie el nombre de la empresa de envíos</p>
            </div>

    
            <div class="admin-slider">

<a href="{{ route('admin.config.index')}}" class="button button-sm">Atrás</a>
    <hr>

{!! Form::open(['route' => ['admin.shipment.update', $shipment->id], 'method' => 'PUT']) !!}
<div class="form-group">
{!! Form::label('name', 'Nombre de la empresa de envíos') !!}
{!! Form::text('name', $shipment->name, ['class' => 'form-control', 'required', 'placeholder' => 'Nombre de la empresa de envíos']) !!}
</div>


<div class="form-group text-center">
    
    {!! Form::submit('Editar', ['class' => 'cart-button'])!!}
    
</div>

{!! Form::close() !!}

    </div>
</div>
    </div>
    </div>
    
@endsection