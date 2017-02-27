@extends('admin.templates.admin')


@section('title', 'Lista de categorias')


@section('content')

<div class="container">

    <div class='admin-container'>
 
        <div class="col-md-12 col-xs-12">
    
            <div class="admin-breadcrumb">
                <h2>Categorías</h2>
                <p>Cree, edite o elimine las categorías de sus artículos</p>
            </div>

    
            <div class="admin-slider">
    
  
       <a href="{{ route('admin.index')}}" class="button button-sm">Atrás</a>
      
   
    <hr>
     
<h2>Nueva categoría</h2>

{!! Form::open(['route' => 'admin.categories.store', 'method' => 'POST', 'files' => true]) !!}

    <div class="form-group">
        
        {!! Form::label('name', 'Nombre') !!}
        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nombre de la categoría', 'required']) !!}
        
    </div>
    
   <!-- <div class="form-group">
    {!! Form::label('gender', 'Género') !!}
    {!! Form::select('gender', ['male' => 'Masculino', 'female' => 'Femenino'], null, ['class'=> 'form-control', 'placeholder' => 'Seleccione un género', 'required'] ) !!}
    
</div>-->
    
    <div class="form-group">
    {!! Form::label('image', 'Imagen de la categoría') !!}
    {!! Form::file('image', null, ['required']) !!}
    
</div>

    <div class="form-group text-center">
    
    {!! Form::submit('Registrar', ['class' => 'button'])!!}
    
</div>


{!! Form::close() !!}

<hr>

<h2>Buscar categoría</h2>

<!-- Buscador de usuarios -->

{!! Form::open(['route' => 'admin.categories.index', 'method' => 'GET', 'class' => 'navbar-form pull-right']) !!}
<div class="input-group">
    
    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Buscar categoría...', 'aria-describedby' => 'searchCategories']) !!}

   
    <span class="input-group-addon" id="searchCategories"><span class="glyphicon glyphicon-search"  aria-hidden="true"></span></span>
    </div>
{!! Form::close() !!}
<!-- Fin buscador de usuarios -->


<hr>
<table class='table table-hover'>
    
    <thead>
        <th>Imagen</th>
        <th>Nombre</th>
       
        <th>Acción</th>
    </thead>
    <tbody>
       @foreach($categoriesrender as $category)
           <tr>
                <td><img src="/images/categories/{{$category->image_url}}" alt="Category image" class="category-image"></td>
               <td>{{$category->name}}</td>
               
           
           
               <td>
                <a href="{{ route('admin.categories.edit', $category->id)}}" class='td-admin'><span class='fa-stack fa-lg' aria-hidden='true'>
                     <i class="fa fa-square fa-stack-2x"></i>
  <i class="fa fa-wrench fa-stack-1x fa-inverse"></i>
                    </span></a>
               <a href="{{ route('admin.categories.destroy', $category->id) }}" onclick="return confirm('Seguro que deseas eliminarlo?')" class='td-admin'><span class='fa-stack fa-lg ' aria-hidden='true'>
                     <i class="fa fa-square fa-stack-2x"></i>
  <i class="fa fa-times fa-stack-1x fa-inverse"></i>
                    </span></a></td>
           </tr>
       @endforeach 
    </tbody>
    
</table>
<div class="text-center">
  {!! $categoriesrender->render() !!} 
</div>

     </div>
</div>
     </div>
      </div>
@endsection