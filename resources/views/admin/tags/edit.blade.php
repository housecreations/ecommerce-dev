@extends('admin.templates.admin')


@section('title', 'Editar tag ' .$tag->name )


@section('content')
<div class="container">

    <div class='admin-container'>
 
        <div class="col-md-12 col-xs-12">
    
            <div class="admin-breadcrumb">
                <h2>Editar tags</h2>
                <p>Edite la etiqueta</p>
            </div>

    
            <div class="admin-slider">
        
         <a href="{{ route('admin.tags.index')}}" class="button button-sm">Atrás</a>
        <hr> 
{!! Form::open(['route' => ['admin.tags.update', $tag->id], 'method' => 'PUT']) !!}

<div class="form-group">
    
   {!! Form::label('name', 'Nombre del tag') !!}
   {!! Form::text('name', $tag->name, ['class' => 'form-control', 'placeholder' => 'Nombre del tag', 'required']) !!}
    
</div>



<div class="form-group text-center">
    
    {!! Form::submit('Editar tag', ['class' => 'cart-button'])!!}
    
</div>


{!! Form::close() !!}
</div>
        </div>
</div>
        </div>
        
@endsection