@extends('admin.templates.admin')

@section('title', 'Panel administracion') 


@section('content') 
<div class="container">

    <div class='admin-container'>
 
        <div class="col-md-12 col-xs-12">
    
            <div class="admin-breadcrumb">
                <h2>Dashboard</h2>
                <p>Ventas, órdenes e imágenes</p>
            </div>

    
            <div class="admin-slider">
         <a href="{{route('admin.payments.search')}}" class="admin-link search-payment">Buscar pago</a> 
            <div class="col-md-12">
            <h2>Totales <p>Este mes</p></h2>
           
              
            
           
           <div class="col-md-6 sale-data">
               <span>{{$totalMonth}} {{$currency}}</span>
               Ingresos del mes
           </div>
           <div class="col-md-6 sale-data">
               <span>{{$totalMonthCount}}</span>
               Cantidad de ventas
           </div>
           
         </div>
           
         
           
           
           
           <div class="col-md-12">
           
           <h2>Órdenes</h2>
           
           
           <div class="col-md-6 sale-data">
             
               <span>{{$orderCount}}</span>
                <a class="admin-link" href="{{url('/admin/orders')}}">
               Ver órdenes del mes
               </a>
           </div>
           
           <div class="col-md-6 sale-data">
            
               <span>{{$orderCount}}</span>
                <a class="admin-link" href="{{url('/admin/orders/all')}}">
              Ver todas las órdenes
               </a>
           </div>
            
           </div>
           
           
        
        <div class="col-md-12">
        <hr>
       <h2>Slider</h2>
         
        <div class="front">
        <a href="{{ route('admin.front.edit')}}">
        @if(sizeof($carousel) > 0)
        <img src="images/slider/{{$carousel[0]->image_url}}" alt="">
        @else
        <img src="images/slider/" alt="">
        @endif
        <div class="templatemo-gallery-image-overlay"></div>
        
       
       </a> </div>
       </div>
       
       
       <div class="col-md-12">
           <hr>
           <h2>Imágenes inicio</h2>
           
           <div class="front-images">
           
           <a href="{{route('admin.front-images.edit')}}">
               @if(sizeof($front_images) > 0)
               <div class="col-md-4"><img src="images/front-images/{{$front_images[0]->image_url}}" alt=""></div>
               <div class="col-md-4"><img src="images/front-images/{{$front_images[1]->image_url}}" alt=""></div>
               <div class="col-md-4"><img src="images/front-images/{{$front_images[2]->image_url}}" alt=""></div>
               <div class="col-md-6"><img src="images/front-images/{{$front_images[3]->image_url}}" alt=""></div>
               <div class="col-md-6"><img src="images/front-images/{{$front_images[4]->image_url}}" alt=""></div>
               @else
                   <div class="col-md-4"><img src="images/front-images/" alt=""></div>
                   <div class="col-md-4"><img src="images/front-images/}" alt=""></div>
                   <div class="col-md-4"><img src="images/front-images/" alt=""></div>
                   <div class="col-md-6"><img src="images/front-images/" alt=""></div>
                   <div class="col-md-6"><img src="images/front-images/" alt=""></div>
                   @endif
               
           </a>
      </div>
           
       </div>
       
        
        
    </div>
    
</div>
</div>
</div>
@endsection