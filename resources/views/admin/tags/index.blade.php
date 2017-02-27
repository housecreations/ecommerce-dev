@extends('admin.templates.admin')


@section('title', 'Lista de tags')


@section('content')

<div class="container">

    <div class='admin-container'>
 
        <div class="col-md-12 col-xs-12">
    
            <div class="admin-breadcrumb">
                <h2>Tags</h2>
                <p>Cree, edite o elimine etiquetas para sus artículos</p>
            </div>

    
            <div class="admin-slider">
  <a href="{{ route('admin.index')}}" class="button button-sm">Atrás</a>
  
    
    <hr>
    <h2>Agregar tag</h2>
    {!! Form::open(['route' => 'admin.tags.store', 'method' => 'POST']) !!}
<div class="form-group">

{!! Form::text('name', null, ['class' => 'form-control', 'required', 'placeholder' => 'Nombre del tag']) !!}
</div>


<div class="form-group text-center">
    
    {!! Form::submit('Agregar tag', ['class' => 'cart-button'])!!}
    
</div>

{!! Form::close() !!}
    
     
<hr>


<!-- Buscador de usuarios -->

{!! Form::open(['route' => 'admin.tags.index', 'method' => 'GET', 'class' => 'navbar-form pull-right']) !!}
<div class="input-group">
    
    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Buscar tag...', 'aria-describedby' => 'searchTags']) !!}

   
    <span class="input-group-addon" id="searchTags"><span class="glyphicon glyphicon-search"  aria-hidden="true"></span></span>
    </div>
{!! Form::close() !!}
<!-- Fin buscador de usuarios -->


<hr>
<table class='table table-hover'>
    
    <thead>
        
        <th>Nombre</th>
       
        <th>Acción</th>
    </thead>
    <tbody>
       @foreach($tags as $tag)
           <tr>
              
               <td>{{$tag->name}}</td>
               
           
           
               <td>
                <a href="{{ route('admin.tags.edit', $tag->id)}}" class='button button-md'>
                    <i class="fa fa-wrench"></i></a>
                    
                    
          {{-- <a href="{{ route('admin.tags.destroy', $category->id) }}" onclick="return confirm('Seguro que deseas eliminarlo?')" class=''><span class='fa-stack fa-lg ' aria-hidden='true'>
                     <i class="fa fa-square fa-stack-2x"></i>
  <i class="fa fa-times fa-stack-1x fa-inverse"></i>
                    </span></a>--}}
                    
                    
                    
                                   
                                   {!! Form::open(['url'=> '/admin/tags/'.$tag->id, 'method' => 'DELETE', 'style' => 'display:block;', 'id' => 'tag_form_'.$tag->id]) !!}
                                       <input type="hidden" name="tag_id" value="{{$tag->id}}">
                   <button class="button button-md" onclick='return confirm("¿Estas seguro?")' type="submit"><i class="fa fa-remove"></i></button>
      
                                    {!! Form::close() !!}
                    
                    
                    
                    </td>
           </tr>
       @endforeach 
    </tbody>
    
</table>
<div class="text-center">
  {!! $tags->render() !!} 
</div>

     </div>
</div>
     </div>
      </div>
      
@endsection