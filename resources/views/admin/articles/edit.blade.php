
@extends('admin.templates.admin')


@section('title', 'Editar artículo ' .$article->name )


@section('content')
<div class="container">

    <div class='admin-container'>
 
        <div class="col-md-12 col-xs-12">
    
            <div class="admin-breadcrumb">
                <h2>Editar artículo</h2>
                <p>Realice el cambio que desee en su artículo</p>
            </div>

    
            <div class="admin-slider">
    
    <a href="{{ route('admin.articles.index')}}" class="button button-sm">Atrás</a>
    <hr>
    
{!! Form::open(['route' => ['admin.articles.update', $article->id], 'method' => 'PUT']) !!}

<div class="form-group">
    
   {!! Form::label('name', 'Nombre') !!}
   {!! Form::text('name', $article->name, ['class' => 'form-control', 'placeholder' => 'Nombre del artículo', 'required']) !!}
    
</div>
    
    
    <div class="form-group">
    
   {!! Form::label('description', 'Descripción') !!}
   {!! Form::textarea('description', $article->description, ['class' => 'form-control', 'placeholder' => 'Descripción', 'required']) !!}
    
</div>  
    

<div class="form-group">
 
     <label for="category">Categoria</label>
    <select class="form-control select-category" required="required" id="category_id" name="category_id">
   
       @foreach($categories as $category)  
        
        

        
        
            @if($category->id == $article->category->id)
            <option selected="selected" value="{{$category->id}}">{{$category->name}}</option>
        @else
             <option value="{{$category->id}}">{{$category->name}}</option> 
        @endif
                
      
                
        @endforeach 
            
        
        </select>
    
</div>
<div class="form-group">
{!! Form::label('tags', 'Tags') !!}
{!! Form::select('tags[]', $tags, $article->tags->lists('id')->ToArray(), ['class' => 'form-control select-tags', 'multiple','required']) !!}
</div>
    
     <div class="form-group">
{!! Form::label('stock', 'Cantidad disponible') !!}
{!! Form::number('stock', $article->stock, ['class' => 'form-control', 'required']) !!}
</div>

<div class="form-group">
{!! Form::label('price', 'Precio') !!}
{!! Form::number('price', $article->price, ['class' => 'form-control', 'required', 'step' => '0.01']) !!}
</div>

<div class="form-group">
{!! Form::label('discount', '% de descuento') !!}
{!! Form::number('discount', $article->discount, ['class' => 'form-control', 'required']) !!}
</div>




<div class="form-group">
    
    {!! Form::submit('Editar', ['class' => 'cart-button'])!!}
    
</div>


{!! Form::close() !!}

    </div>
</div>
</div>
</div>
@endsection



@section('js')
 <script src="{{ asset('plugins/chosen/chosen.jquery.js') }}"></script>
 <script>
$('.select-tags').chosen({
    placeholder_text_multiple: 'Seleccione un máximo de 5 tags',
    max_selected_options: 5
});
     $('.select-category').chosen({
         no_results_text: 'No se encontraron categorias'
     });
</script>
@endsection