@extends('admin.templates.principal')

@section('title', "HouseCreations Shop") 

@section('css')
<link rel="stylesheet" href="{{ asset('css/flexslider.css')}}">
@endsection

@section('content') 


 <!-- Slider -->
       <div class="slider-container">
            <div id="slider" class="sl-slider-wrapper">

        <!--Slider Items-->    
        <div class="sl-slider">
           
        @foreach($carousel as $image)
 <!--Slider Item2-->
            <div class="sl-slide item2" data-orientation="vertical" data-slice1-rotation="0" data-slice2-rotation="0" data-slice1-scale="1.5" data-slice2-scale="1.5">
                <div class="sl-slide-inner">
                    <div class="">
                      <a href="{{$image->url_to}}">
                    
                       
                        <img class="slider-img" src="images/slider/{{$image->image_url}}" alt="Imagen {{$image->id}}" />
                       </a>
                    </div>
                </div>
            </div>
            @endforeach



           

    </div>
    <!--/Slider Items-->

    <!--Slider Next Prev button-->
    <nav id="nav-arrows" class="nav-arrows">
        <span class="nav-arrow-prev"><i class="fa fa-angle-left"></i></span>
        <span class="nav-arrow-next"><i class="fa fa-angle-right"></i></span> 
    </nav>
    <!--/Slider Next Prev button-->

</div>
<!-- /slider-wrapper -->  
       </div>

<!--new products-->

<div class="container front-images">

    @foreach($front_images->forPage(1,3) as $image)
    <div class="col-md-4 col-sm-4 col-xs-12 front-images-item">
        <a href="#">
        <img src="/images/front-images/{{$image->image_url}} " alt="Front image">
        <h2 class="title wow fadeInLeft">{{$image->title}}</h2>
        <h2 class="sub-title wow fadeInRight">{{$image->sub_title}}</h2>
        </a>
    </div>
    @endforeach

</div>



 @if(!$featuredArticles->isEmpty())
<div class="container new-products">
  <hr class="hr">
  

  @include('admin.templates.partials.featured-articles') 

 
    
</div>
@endif

<!--new products-->

<div class="container front-images margin-top-bottom">
    @foreach($front_images->forPage(2,3) as $image)
    <div class="col-md-6 col-sm-6 col-xs-12 front-images-item">
        <a href="#">
        <img src="/images/front-images/{{$image->image_url}}" alt="Front image">
        <h2 class="title-big wow fadeInRight">{{$image->title}}</h2>
        <h2 class="sub-title-big wow fadeInRight">{{$image->sub_title}}</h2>
        </a>
    </div>
    @endforeach
   
</div>

@if(!$newArticles->isEmpty())
<div class="container new-products">
  <hr class="hr">
  
  <h2 class="text-center related-title"> Artículos recientes</h2>
   
   <div class="col-md-12">
                                
     @foreach($newArticles as $article)
                                
                                
                                
                                
                                <div class="col-md-3 col-sm-6 col-xs-12">
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
                              
                    </div>   
    
</div>
@endif

@endsection

@section('js')
    
    <!-- Required javascript files for Slider -->

<script src="js/slider/jquery.ba-cond.min.js"></script>
<script src="js/slider/jquery.slitslider.js"></script>
<!-- /Required javascript files for Slider -->

<!-- SL Slider -->
<script type="text/javascript"> 
$(function() {
    var Page = (function() {

        var $navArrows = $( '#nav-arrows' ),
        slitslider = $( '#slider' ).slitslider( {
            autoplay : false
        } ),

        init = function() {
            initEvents();
        },
        initEvents = function() {
            $navArrows.children( ':last' ).on( 'click', function() {
                slitslider.next();
                return false;
            });

            $navArrows.children( ':first' ).on( 'click', function() {
                slitslider.previous();
                return false;
            });
        };

        return { init : init };

    })();

    Page.init();
});
</script>



 <script src="{{ asset('js/articles-slider/jquery.flexslider.min.js') }}"></script>


 

<!-- /SL Slider -->
@endsection

