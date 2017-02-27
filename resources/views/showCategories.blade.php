@extends('admin.templates.principal')
 @if(sizeof($categoriescat)==0)
 @section('title', 'No se encontraron categorías') 
 @else
@section('title', 'Categorías') 
@endif


@section('css')
<link rel="stylesheet" href="{{ asset('css/flexslider.css')}}">

@endsection

@section('content') 
   <div class="container">
    <div class="items"> 
   
      
    @if(sizeof($categoriescat)==0)
    <ol class="breadcrumb bc text-center">
  <li><a href="/">Inicio</a></li>
<hr>
  
</ol>

<h4 class="text-center">Lo sentimos, no se encontraron categorías</h4>

</div>
</div>
     @else
       
      
       <ol class="breadcrumb bc text-center">
  <li><a href="/">Inicio</a></li>

    
    <li class="active">Categorías</li>
  <hr>
</ol>
      
      
      <h1 class="text-left categories-title">Categorías</h1>
       
     @foreach($categoriescat as $category)
   
    
    <div class="col-md-4 col-sm-4 col-xs-12 front-images-item">
       <a href="/articulos/{{$category->slug}}" >
        <img class="img-categories" src="/images/categories/{{$category->image_url}}" alt="Category Image">
        <h2 class="title wow fadeInLeft">{{$category->name}}</h2>
       
        </a>
        <p class="text-center cat-p">{{$category->articlesCount()}} artículos</p>
    </div>
   
    
    
   {{-- <div class="col-md-6 col-sm-6 col-xs-12 item-content">
    
          
   
			    	    
         <a href="/articulos/{{$category->slug}}" >
   <div class="grid mask">
                   
						<figure>
							<img class="img-responsive" src="/images/articles/{{$category->articles[0]->images[0]->image_url}}" alt="">
							<figcaption>
								<h5>{{$category->name}}</h5>
								
								
							</figcaption><!-- /figcaption -->
						</figure><!-- /figure -->
			    	</div><!-- /grid-mask -->
    
        </a>
        
        
 
   
    </div>--}}
   
    @endforeach
  
  @endif
  </div>
  
  
   </div>
   
   <div class="container new-products">
  <hr class="hr">
  
   @include('admin.templates.partials.featured-articles') 
       </div>

@endsection


@section('js')
<script src="{{ asset('js/articles-slider/jquery.flexslider.min.js') }}"></script>
@endsection