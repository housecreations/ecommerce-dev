@extends('admin.templates.admin')

@section('title', 'Imagenes inicio') 


@section('content') 




<div class="container">

<div class="admin-container">


<div class="col-md-12 col-xs-12">
    
            <div class="admin-breadcrumb">
                <h2>Imágenes del slider</h2>
                <p>Edite sus imágenes</p>
            </div>

    <div class="admin-slider">
   
   
    <a href="{{ route('admin.index')}}" class="admin-link link-lg">Atrás</a>
         <a href="{{ route('admin.front.mas')}}" class="admin-link link-lg">Nueva imagen</a>
         <a href="{{ route('admin.front.menos')}}" class="admin-link link-lg">Eliminar imagen</a>
<hr>
   




<div class="col-md-12">
    
    
    
@foreach($images as $image)

<div class="col-md-6 col-sm-6 col-xs-12 admin-item-content">
<div class="image">
    <img src="/images/slider/{{$image->image_url}}" alt="">
</div>
<div class="col-md-11">
{!! Form::open(['route' => ['admin.front.update', $image->id], 'method' => 'PUT', 'files' => true]) !!}



<div class="form-group">
    
   {!! Form::label('url_to', 'URL a redirigir') !!}
   {!! Form::text('url_to', $image->url_to, ['class' => 'form-control', 'placeholder' => 'www.ejemplo.com/ruta-a-mostrar']) !!}
    
</div>


<div class="form-group">
    {!! Form::label('image', 'Cargar imagen') !!}
    {!! Form::file('image') !!}
    
</div>
</div>
<div class="col-md-12">
<div class="form-group">
    
    {!! Form::submit('Editar', ['class' => 'button'])!!}
    
</div>

</div>

{!! Form::close() !!}

</div>
  @endforeach 
    
    </div>
    
    
    
    
    </div>
    </div>
  </div>
    
  


@endsection