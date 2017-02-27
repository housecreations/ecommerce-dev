<!DOCTYPE html>
<html lang="es">
<head>
<title>@yield('title', 'Default')</title>




<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	
    <meta name="keywords" content="a2 softway, maquina fiscal">
	<meta name="description" content="">
       <meta name="author" content="housecreations">
    <meta name="owner" content="D'sistemas y PC, C.A.">
    <!-- 
	Medigo Template
	http://www.templatemo.com/preview/templatemo_460_medigo
    -->
    
	<!-- Google Fonts -->
	<link href="http://fonts.googleapis.com/css?family=PT+Serif:400,700,400italic,700itali" rel="stylesheet">
	<link href="http://fonts.googleapis.com/css?family=Raleway:400,900,800,700,500,200,100,600" rel="stylesheet">




	<!-- Stylesheets -->
	<link rel="stylesheet" href="{{ asset('css/bootstrap.css')}}">
<link rel="stylesheet" href="{{ asset('css/flexslider.css')}}">
<link rel="stylesheet" href="{{ asset('css/blue-scheme.css')}}">
<link rel="stylesheet" href="{{ asset('css/animate.min.css')}}">
<link rel="stylesheet" href="{{ asset('css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/nivo-slider.css')}}">

	
	<!-- JavaScripts -->
	
 <!--<script src="{{ asset('js/jquery.min.js') }}"></script> 
<script src="{{ asset('js/jquery-1.10.2.min.js') }}"></script>
		
	<script src="{{ asset('js/jquery-migrate-1.2.1.min.js') }}"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	-->
	
	<script src="{{ asset('js/jquery-1.10.2.min.js') }}"></script>
	<script src="{{ asset('js/jquery-migrate-1.2.1.min.js') }}"></script>


<script src="{{ asset('js/min/bootstrap.js') }}"></script> 
			
    
    <script src="{{ asset('js/modernizr.custom.js') }}"></script> 
   
	

@yield('js-top')

</head>

<body>
<div id="preloader">
    <div id="loader"></div>
</div>
<!--==============================
              header
=================================-->


    @include('admin.templates.partials.nav') 
    
    
 
<!--=====================
          Content
======================-->
<section id="" class="">
  
    
     
        @include('flash::message')
        @include('admin.templates.partials.errors')
      
        
  
        @yield('content')
     
    
    
</section>

<!--==============================
              footer
=================================-->
<!-- Socialize -->
	<footer>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<ul class="social-icon" data-wow-delay="0.3s">
						<li><a href="#" class="fa fa-facebook"></a></li>
						<li><a href="#" class="fa fa-twitter"></a></li>
						<li><a href="#" class="fa fa-instagram"></a></li>
					</ul>
					<p class="wow fadeInUp">Copyright 2016 &copy; <span>D'Sistemas Y PC, CA.</span> 
                    | Desarrollado por: <a rel="nofollow" href="http://www.housecreations.com.ve" target="_blank"><span class="hc">House Creations</span></a></p>
				</div>
			</div>
		</div>
	</footer>

<!--
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>


-->
  <script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
 <script>
$('div.alert').not('.alert-important').delay(3000).slideUp(350);
</script>

<script src="{{ asset('js/min/plugins.min.js') }}"></script>

<script src="{{ asset('js/medigo-custom.js') }}"></script>
<script src="{{ asset('js/wow.min.js') }}"></script>
 <script src="{{ asset('js/jquery.flexslider.min.js') }}"></script>
    
    
   


</body>
</html>