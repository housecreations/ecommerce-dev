

       
       
       <div class="responsive_menu">
        <ul class="main_menu">
           
					            <li><a href="/quienes-somos">Nosotros</a>
                                   
                                    <li><a href="/articulos">Categorías</a>
					            	<ul>
                                        @foreach($categories as $category)
					            		<li><a href="/articulos/{{$category->slug}}">{{$category->name}}</a></li>
					            		
                                        @endforeach
                                         <li><a href="/descuentos">Descuentos</a></li>
					            	</ul>
					            </li>
					            
					            
					            <li><a href="{{ route('contact')}}">Contacto</a></li>
                                
                                
                                
                                
                                
                                 @if(Auth::user())
                    
                                 <li><a href="#">{{Auth::user()->name}}</a>
					            	<ul>
					            	@if(Auth::user()->type == 'admin')
					            		<li><a href="{{ route('admin.index')}}">Panel de control</a></li>
					            		<li><a href="{{ route('admin.password.edit')}}">Mi cuenta</a></li>
					            		<li><a href=" {{ route('admin.config.index')}}">Configuración
                                        </a></li>
					            		@else
					            		<li><a href="{{ route('member.index')}}">Mi cuenta</a></li>
					            		@endif
					            		<li><a href="{{ route('admin.auth.logout')}}">Salir</a></li>
					            		
					            	</ul>
					            </li>
                                
                                @else
                                 <li><a href="{{route('admin.auth.login')}}">Iniciar sesión</a></li>
                                @endif
                                
        </ul> <!-- /.main_menu -->
    </div> <!-- /.responsive_menu -->

	<header class="site-header clearfix">
		<div class="">
       @if(Auth::user())
       
        @if(Auth::user()->type == 'member')
         <a href="{{url('/carrito')}}" class="carrito"> <span class="item-count">{{$productsCount}} </span><i class="fa fa-shopping-cart"></i></a>
        @endif
        @else
        <a href="{{url('/carrito')}}" class="carrito"><span class="item-count">{{$productsCount}} </span><i class="fa fa-shopping-cart"></i> </a>
        
        @endif
			<div class="row">

				<div class="col-md-12">

					<div class="pull-left logo">
						<a href="/">
							<img src="{{asset('images/logo.png')}}" alt="Logo">
						</a>
					</div>	<!-- /.logo -->

					<div class="main-navigation pull-right">

						<nav class="main-nav visible-md visible-lg">
							<ul class="sf-menu">
								
					            <li><a href="/quienes-somos">Nosotros</a>
                                   
                                    <li><a href="/articulos">Categorías</a>
					            	<ul>
                                        @foreach($categories as $category)
					            		<li><a href="/articulos/{{$category->slug}}">{{$category->name}}</a></li>
					            		
                                        @endforeach
                                        <li><a href="/descuentos">Descuentos</a></li>
					            	</ul>
					            </li>
					            
					           
					            <li><a href="{{ route('contact')}}">Contacto</a></li>
                                
                                
                                
                                
                                
                                 @if(Auth::user())
                                 <li><a href="#">{{Auth::user()->name}}</a>
					            	<ul>
					            		@if(Auth::user()->type == 'admin')
					            		<li><a href="{{ route('admin.index')}}">Panel de control</a></li>
					            		<li><a href="{{ route('admin.password.edit')}}">Mi cuenta</a></li>
					            		<li><a href=" {{ route('admin.config.index')}}">
                                        Configuración
                                        </a></li>
					            		@else
					            		<li><a href="{{ route('member.index')}}">Mi cuenta</a></li>
					            		@endif
					            		<li><a href="{{ route('admin.auth.logout')}}">Salir</a></li>
					            		
					            	</ul>
					            </li>
                                
                                @else
                                 <li><a href="{{route('admin.auth.login')}}">Iniciar sesión</a>
                                 </li>
                                 
                                @endif
                                
                                
                                
                                
							</ul> <!-- /.sf-menu -->
						</nav> <!-- /.main-nav -->

						<!-- This one in here is responsive menu for tablet and mobiles -->
					    <div class="responsive-navigation visible-sm visible-xs">
					        <a href="#nogo" class="menu-toggle-btn">
					            <i class="fa fa-bars"></i>
					        </a>
					    </div> <!-- /responsive_navigation -->

					</div> <!-- /.main-navigation -->

				</div> <!-- /.col-md-12 -->

			</div> <!-- /.row -->

		</div> <!-- /.container -->
	</header> <!-- /.site-header -->


<nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
	
	{!! Form::open(['url' => '/buscar-articulos', 'method' => 'GET', 'class' => '', 'id' => 'search-articles']) !!}

 
   
  
    
  
    
    
    
    
    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Buscar articulo...', 'id' => 'search-articles-sub']) !!}

    
    
   
{!! Form::close() !!}
	<button id="showLeft"><i class="fa fa-search"></i></button>
</nav>




            