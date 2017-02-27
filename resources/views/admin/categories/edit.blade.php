@extends('admin.templates.admin')


@section('title', 'Editar área ' .$category->name )


@section('content')
<div class="container">

    <div class='admin-container'>
 
        <div class="col-md-12 col-xs-12">
    
            <div class="admin-breadcrumb">
                <h2>Agregar categoría</h2>
                <p>Cree una nueva categoría para artículos</p>
            </div>

    
            <div class="admin-slider">
        
         <a href="{{ route('admin.categories.index')}}" class="button button-sm">Atrás</a>
        <hr> 
{!! Form::open(['route' => ['admin.categories.update', $category->id], 'method' => 'PUT', 'files' => true]) !!}

<div class="form-group">
    
   {!! Form::label('name', 'Nombre') !!}
   {!! Form::text('name', $category->name, ['class' => 'form-control', 'placeholder' => 'Nombre de la categoria', 'required']) !!}
    
</div>

<div class="form-group">
    
   <div class="col-md-12">
       
       <img src="/images/categories/{{$category->image_url}}" alt="Category image" class="category-edit-img">
       
   </div>
    
</div>  

<div class="form-group">
    {!! Form::label('image', 'Imagen de la categoría') !!}
    {!! Form::file('image') !!}
    
</div>

<div class="form-group text-center">
    
    {!! Form::submit('Editar', ['class' => 'button'])!!}
    
</div>


{!! Form::close() !!}
</div>
        </div>
</div></div>

@endsection