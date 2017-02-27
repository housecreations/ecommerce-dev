@extends('admin.templates.principal')

@section('meta-tags')
<meta name="keywords" content="a2 softway, maquina fiscal">
<meta name="description" content="{{$article->description}}">

@endsection


@section('title', $article->name) 

@section('css')
<link rel="stylesheet" href="{{ asset('css/flexslider.css')}}">

@endsection

@section('js-top')

@endsection


@section('content') 
  
  <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v2.8";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
  
  
  
{{--{{$article->articlesDetails}}
   --}}
   <div class="container">
   
   <div class="items">
    <ol class="breadcrumb bc text-center">
  <li><a href="/">Inicio</a></li>

    
    <li><a href="/articulos">Categorías</a></li>
  
    <li> <a href="/articulos/{{$article->category->slug}}"> {{$article->category->name}}</a></li>
   
  
   
    <li class="active"> {{$article->name}}</li>
  <hr>
</ol>
   
  
   
   
     
   
   
  
  
  <div class="col-md-6 img-container col-sm-6 col-xs-12">
  
  
   <div id="slider" class="flexslider">
                             @if($article->discount > 0)
                    <div class="oferta-article">{{$article->price}} {{$currency}}</div>
                    @endif
                              <ul class="slides">
                                
    @foreach($article->images as $image)
                                 
                                 <li>
                                  <img src="/images/articles/{{$image->image_url}}" alt="Slide {{$image->id}}"/>
                                  
                              </li>
                              
                              @endforeach
                              
                          </ul>
                      </div>
                     
                <div id="carousel" class="flexslider">
                          <ul class="slides">
                         
                             
                 @foreach($article->images as $image)                 
                           <li>
                              <img src="/images/articles/{{$image->image_url}}" alt="Thumbnail {{$image->id}}"/>
                          </li>
                          
                          @endforeach
                         
                      </ul>
                  </div>       
                    
   </div>
  
  
  
   <div class="col-md-5 item-description col-sm-6 col-sm-offset-0 col-xs-10 col-xs-offset-1">
      
      <div class="row up">
      <span class="title">{{$article->name}}</span>
     </div>
      <div class="row up">
      <div class="price">{{$article->price_now}} {{$currency}} </div>
      
      <hr>
     
      
      
      
      
      
      
      
      </div>
      
      <div class="row up">
       
      <span class="bold-span"> Disponibilidad: </span>
     
      @if($article->stock > 0)
      
      <span> En existencia</span>
      @else
      <span> Agotado</span>
      
      @endif
       </div>
      
      <div class="row up">
            @if(Auth::user())
          @if($article->stock > 0 && Auth::user()->type == 'member')
           
                  <div class="agregar-carrito">
                   
                  
                   
                            
                   @include('in_shopping_carts.form', ['article' => $article])
                   
                </div>
               
                @endif
                @else
                 @if($article->stock > 0)
                
        <div class="agregar-carrito">
                   
                  
                   
                            
                   @include('in_shopping_carts.form', ['article' => $article])
                   
                </div>
               
                @endif
                @endif
      <hr>
      </div>
      
      <div class="row up">
          <span class="bold-span">Descripción</span>
          <p class="description">{{$article->description}}</p>
          <hr>
      </div>
      
      
      <div class="row up">    
       
            <span>Tags: </span>
            @foreach($article->tags as $tag)
            <a class="" href="{{url('/tags/'.$tag->slug)}}">{{$tag->name}}</a>
            @endforeach
       
        <hr>
        </div>
        
        <div class="row up">
           
         
            <span><a href="https://twitter.com/share?text={{$article->name}} por tan sólo {{$article->price_now}} {{$currency}}" class="popup share" data-show-count="false"><i class="fa fa-twitter"></i></a>
               
              <a href="http://www.facebook.com/sharer.php?s=100&p[url]={{Request::url()}}?s=100&p[title]={{$article->name}}" class="popup share"><i class="fa fa-facebook"></i></a>
               
               <script>
                
	
  $('.popup').click(function(event) {
	
    var width  = 600,
	
        height = 400,
	
        left   = ($(window).width() - width)  / 2,
	
        top    = ($(window).height() - height) / 2,
	
        url    = this.href,
	
        opts   = 'status=1' +
	
                 ',width='  + width  +
	
                 ',height=' + height +
	
                 ',top='    + top    +
	
                 ',left='   + left;

 

    window.open(url, '', opts);
	
 
	
    return false;
	
  });
	
</script>
           
          
           
           
           </span>
           
    
           
           
        
           
            
        </div>
     
      
          
     
    {{--  <div class="row">
          <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
  
   
   
   
  <div class="panel panel-default">
   
   <div class="panel-heading" role="tab" id="heading1">
      
        <a class="nohover" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse1" aria-expanded="true" aria-controls="collapse1">
         
        <h4 class="panel-title big">
        Descripción
        </h4>
       
        </a>
       </div>
    
    
     
     <div id="collapse1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading1">
      <div class="panel-body">
        
        <p>{{$article->description}}</p>   
        
      </div>
    </div>
    
    
    
    
  </div>
  </div> <!-- row -->
   
  

  </div>  --}}
        
        
        {{--   <div class="row">
           <div class="tags" style="display: block;">
            <h4>Productos relacionados</h4>
             
               
               
               
               <div id="slider-related" class="flexslider">
                              <ul class="slides">
                                
     @foreach($relatedArticles as $article_related)
                                 
                                 <li>
                                 <a href="{{url('/articulos/'.$article_related->category->slug.'/'.$article_related->slug)}}">
                                 
                                 <span class="text-center related-title">{{$article_related->name}}</span>
                                  <img src="/images/articles/{{$article_related->images[0]->image_url}}" alt="Slide {{$article_related->id}}"/>
                                 
                                  </a>
                                
                              </li>
                              
                              @endforeach
                              
                          </ul>
                      </div>
            
           
        </div>
            </div>--}}
             
               
                
               
          {{--  <div class="row">    
        <div class="tags">
            <h4>Tags</h4>
            @foreach($article->tags as $tag)
            <a class="tag" href="{{url('/tags/'.$tag->slug)}}">{{$tag->name}}</a>
            @endforeach
        </div>
        
        </div>
                
      
      --}}
      
     
   </div>
   
   
  
  
   
      
   
   </div>
   <div class="items no-margin-top">
    <hr class="hr">
    
    <h2 class="text-center related-title">Artículos relacionados</h2>
    
    
     <div class="">
           <div class="tags" style="display: block;">
          
             
               
               
               
               <div id="slider-related" class="flexslider">
                              <ul class="slides">
                                
     @foreach($relatedArticles as $article_related)
                                 
                                 <li>
                                 
                                 
                                 
                    <div class="about-thumb">
                     
                     @if($article_related->discount > 0)
                    <div class="oferta">{{$article_related->discount}}% de descuento</div>
                    @endif
                     
                      <a href="{{url('/articulos/'.$article_related->category->slug.'/'.$article_related->slug)}}">
                       
                        <img class="recent-articles" src="/images/articles/{{$article_related->images[0]->image_url}}" alt="Slide {{$article_related->id}}"/>
                              <div class="about-overlay">
                                   <h3>{{$article_related->name}}</h3>
                                   <h4>{{$article_related->price_now}} {{$currency}}</h4>
                            @if(Auth::user())
                            @if(Auth::user()->type == 'member')
                            @if($article_related->stock > 0)      
                             
                             @include('in_shopping_carts.form', ['article' => $article_related])
                            
                            @endif
                            @endif
                            
                            @else
                            @if($article_related->stock > 0)      
                            
                            
                             @include('in_shopping_carts.form', ['article' => $article_related])
                            
                            @endif
                            @endif
                                       
                                 
                              </div>
                              </a>
                    </div>
              
                           
                              </li>
                              
                              @endforeach
                              
                          </ul>
                      </div>
            
           
        </div>
            </div>
    
    
   </div>
   </div>
   
   
   
   
@endsection


@section('js')
 <script src="{{ asset('js/articles-slider/jquery.flexslider.min.js') }}"></script>
 
 
@endsection