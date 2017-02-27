@extends('admin.templates.principal')
 @if(sizeof($articles)==0)
 @section('title', 'No se encontraron articulos') 
 @else
@section('title', 'En descuento') 
@endif


@section('content') 
<div class="container">
    <div class="items"> 
   
      
    @if(sizeof($articles)==0)
    <ol class="breadcrumb bc text-center">
  <li><a href="/">Inicio</a></li>

  
</ol>

<h4 class="text-center">Lo sentimos, no se encontraron artículos</h4>

</div>
     @else
       
      
       <ol class="breadcrumb bc text-center">
  <li><a href="/">Inicio</a></li>

    <li class="active">Descuentos</li>
  <hr>
</ol>
      
       <h1 class="text-left categories-title">Descuentos</h1>
       
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
          {{$articles->render()}}
      </div>
  </div>
  @endif
  
   </div>
   </div>
   
@endsection