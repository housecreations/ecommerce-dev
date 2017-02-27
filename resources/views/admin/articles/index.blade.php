@extends('admin.templates.admin')


@section('title', 'Lista de artículos')


@section('content')


<div class="container">

    <div class='admin-container'>
 
        <div class="col-md-12 col-xs-12">
    
            <div class="admin-breadcrumb">
                <h2>Artículos</h2>
                <p>Gestione sus artículos</p>
            </div>

    
            <div class="admin-slider">
   
        <a href="{{ route('admin.index')}}" class="button button-sm">Atrás</a>
        <a href="{{ route('admin.articles.create') }}" class='button button-md'>Nuevo Artículo</a>
    <hr>
    
    



<!-- Buscador de articulos -->
<div class="row">
{!! Form::open(['route' => 'admin.articles.index', 'method' => 'GET', 'class' => 'navbar-form']) !!}
<div class="input-group">
    
    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Buscar articulo...', 'aria-describedby' => 'searchArticles']) !!}

   
   
    </div>
{!! Form::close() !!}
</div>
<!-- Fin buscador de usuarios -->


<hr>

    
  
       @foreach($articles as $article)
           
             
            <div class="col-md-4 col-sm-6 col-xs-12 admin-item-content">
            <h5>{{$article->name}}</h5>
            <div class="actions-content">
               
              {{-- <a id="eye_{{$article->id}}" href="{{ route('admin.articles.visible', $article->id)}}" class=''><span class='fa-stack fa-lg ' aria-hidden='true'>
                     <i class="fa fa-square fa-stack-2x"></i>
  <i class="fa fa-eye fa-stack-1x fa-inverse"></i>
                    </span></a>
                  --}}  
                    
                    
                    {!! Form::open(['route' => ['admin.articles.visible', $article->id], 'method' => 'POST', 'id' => "visible_form_$article->id", 'class' => 'visible form-visible']) !!}

<input type="hidden" name="article_id" value="{{$article->id}}">

 

       
@if($article->visible == 'yes')
<button type="submit" class="button-visible ">
   Visible
</button>
@else
<button type="submit" class="button-visible no-visible">
   Oculto
</button>
@endif

{!! Form::close() !!}
                    
                    
            
                   
     {!! Form::open(['route' => ['admin.discount', $article->id], 'method' => 'POST', 'id' => "discount_form_$article->id", 'class' => 'visible form-discount']) !!}

<input type="hidden" name="article_id" value="{{$article->id}}">

 

       
@if($article->on_discount == 'yes')
<button type="submit" class="button-discount ">
   En descuento
</button>
@else
<button type="submit" class="button-discount no-discount">
   Sin descuento
</button>
@endif

{!! Form::close() !!}
                                                 
                                                 
 {!! Form::open(['route' => ['admin.featured', $article->id], 'method' => 'POST', 'id' => "featured_form_$article->id", 'class' => 'visible form-featured']) !!}

<input type="hidden" name="article_id" value="{{$article->id}}">

 

       
@if($article->featured == 'yes')
<button type="submit" class="button-featured ">
   Destacado
</button>
@else
<button type="submit" class="button-featured no-featured">
   No destacado
</button>
@endif

{!! Form::close() !!}
                                                  
                    
                        
                                
               
               
                <a href="{{ route('admin.articles.images', $article->id)}}" class=''><span class='fa-stack fa-lg ' aria-hidden='true'>
                     <i class="fa fa-square fa-stack-2x"></i>
  <i class="fa fa-photo fa-stack-1x fa-inverse"></i>
                    </span></a>
                
                
                <a href="{{ route('admin.articles.edit', $article->id)}}" class=''><span class='fa-stack fa-lg ' aria-hidden='true'>
                     <i class="fa fa-square fa-stack-2x"></i>
  <i class="fa fa-wrench fa-stack-1x fa-inverse"></i>
                    </span></a>
               <a href="{{ route('admin.articles.destroy', $article->id) }}" onclick="return confirm('Seguro que deseas eliminarlo?')" class=''><span class='fa-stack fa-lg ' aria-hidden='true'>
                     <i class="fa fa-square fa-stack-2x"></i>
  <i class="fa fa-times fa-stack-1x fa-inverse"></i>
                    </span></a>
                </div>
                  
            
            <img src="/images/articles/{{$article->images[0]->image_url}}" alt="">  
               <span>Precio: {{$article->price}} {{$currency}}</span><br>
                <span>Unidades: {{$article->stock}}</span><br>
                <span>Descuento: {{$article->discount}}%</span>
                <hr>
                 <span>{{$article->category->name}}</span>
                 <hr>
                  
                  @foreach($article->tags as $tag)
                  <span class="tag">{{$tag->name}}</span>
                 @endforeach
        
            
               
                </div>
              
                
               
               
               
               
               
               
               
          
       @endforeach 
  
    

<div class="text-center">
  {!! $articles->render() !!} 
</div>

     </div>
</div>
 </div>
</div>
@endsection