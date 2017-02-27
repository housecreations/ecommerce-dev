@extends('admin.templates.principal')


@section('title', 'Lista de artículos')


@section('content')


<div class="container">

    
 
        <div class="items">
    
    <ol class="breadcrumb bc text-center">
  <li><a href="/">Inicio</a></li>
    <li class="active">Buscar artículos</li>
  <hr>
</ol>
    
   <h1 class="text-left categories-title">Buscar artículos</h1> 



<!-- Buscador de articulos -->
<div class="row">
{!! Form::open(['url' => '/buscar-articulos', 'method' => 'GET', 'class' => 'navbar-form', 'id' => 'search-articles-form']) !!}

  <div class="sort-by">
   
      <select name="select" id="sort-select" class="form-control">
        <option value="">Ordenar</option>
       
        <option value="id-desc">Nuevos</option>
        
        
      
        <option value="id-asc">Viejos</option>
  
        
     
       <option value="price-desc">Precios: Mayor > Menor</option>
    
        
       
         
     
       <option value="price-asc">Precios: Menor > Mayor</option>
       
         
        
         
         
    </select>
  </div>
   
   
   <div class="input-group article-search">
    
     <input type="hidden" id="sortSelect" name="sortSelect" value="">
    <input type="hidden" id="orderType" name="orderType" value="">
    
    
    
    
    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Buscar articulo...', 'aria-describedby' => 'searchArticles', 'id' => 'search-articles-submit']) !!}

    
    
    </div>
{!! Form::close() !!}
</div>
<!-- Fin buscador de usuarios -->


<hr>

    @if($articles->count() == 0)
    <h4 class="text-center">No se encontraron artículos</h4>
    @endif
  
       @foreach($articles as $article)
           
                  
                                <div class="col-md-3" data-wow-delay="0.4s">
                               
                    <div class="about-thumb">
                     
                      @if($article->discount > 0)
                    <div class="oferta">{{$article->discount}}% de descuento</div>
                    @endif
                     
                      <a href="{{url('/articulos/'.$article->category->slug.'/'.$article->slug)}}">
                       
                        <img class="recent-articles" src="/images/articles/{{$article->images[0]->image_url}}" alt="Slide {{$article->id}}"/>
                              <div class="about-overlay">
                                   <h3>{{$article->name}}</h3>
                                   <h4>{{$article->price_now}} {{$currency}}</h4>
                            @if(Auth::user())
                            @if(Auth::user()->type == 'member')
                            @if($article->stock > 0)      
                             
                             @include('in_shopping_carts.form', ['article' => $article])
                            
                            @endif
                            @endif
                            @else
                            @if($article->stock > 0)      
                            
                            
                             @include('in_shopping_carts.form', ['article' => $article])
                            
                            @endif
                            @endif
                                       
                                 
                              </div>
                              </a>
                    </div>
               </div>
     
     
                     
          
       @endforeach 
  
    
<div class="col-md-12">
<div class="text-center">
  {!! $articles->appends(['sortSelect'=>  $request->sortSelect, 'orderType'=> $request->orderType, 'name' => $request->name])->render() !!} 
</div>
</div>
     </div>
</div>

@endsection


