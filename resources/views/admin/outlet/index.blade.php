@extends('admin.templates.principal')


@section('title', 'Descuentos')


@section('content')



<div class="items-no-nav col-md-10 col-sm-10 col-xs-12 card">



<a href="{{ route('admin.index')}}" class="button button-sm">Atrás</a>




<a href="{{route('admin.outlet.show')}}" class="button button-lg">Ver artículos en descuento
</a>

<hr>
  

<h4 class="text-center top-space">Seleccione un artículo para agregar a descuentos</h4>
<hr>



<div class="col-md-12"> 

    @foreach($articles as $article)
    
    <div class="col-md-4 col-sm-6 col-xs-12 admin-item-content">
   
   
    <a class="" href="{{ route('admin.outlet.add', $article->id)}}">
   <h4>{{$article->name}}</h4>
   
   
    <div>
							<img src="/images/articles/{{$article->images[0]->image_url}}" alt="Gallery Item">
							
							
						
									
									<h4>{{$article->price}} bs</h4>
								
							
						</div>	
    
        </a>
    
    
    
 
   
    </div>
     
    @endforeach

</div>

</div>


@endsection