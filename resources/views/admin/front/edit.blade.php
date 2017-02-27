@extends('admin.templates.principal')

@section('title', 'Imagenes inicio') 


@section('content') 


 @include('admin.templates.partials.adminnav')

<div class="col-md-2"></div>
<div class="col-md-8">
<div class="image">
    <img src="{{$front->$column}}" alt="">
</div>

<div class="col-md-6">
{!! Form::open(['route' => ['admin.front.update', 1, $column], 'method' => 'PUT', 'files' => true]) !!}

<div class="form-group">
    
   {!! Form::label($column, 'URL de la imagen') !!}
   {!! Form::text($column, $front->$column, ['class' => 'form-control', 'placeholder' => 'URL imagen', 'required']) !!}
    
</div>



<div class="form-group">
    {!! Form::label('image', 'Cargar imagen') !!}
    {!! Form::file('image') !!}
    
</div>
</div>
<div class="col-md-12">
<div class="form-group">
    
    {!! Form::submit('Editar', ['class' => 'btn btn-primary'])!!}
    
</div>
<h5><span>Puede usar una URL o cargar la imagen usted mismo</span></h5>
</div>

{!! Form::close() !!}



</div>




@endsection