<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    
    <script src="{{asset('catalogo/js/jquery.min.js')}}" defer></script>
    <script src="{{asset('catalogo/js/bootstrap.min.js')}}"defer></script>
    <script src="{{asset('catalogo/js/slick.min.js')}}"defer></script>
    <script src="{{asset('catalogo/js/nouislider.min.js')}}"defer></script>
    <script src="{{asset('catalogo/js/jquery.zoom.min.js')}}"defer></script>
    <script src="{{asset('catalogo/js/main.js')}}"defer></script>
	
	<!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <!-- Google font -->
		<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

		<!-- Bootstrap -->
		<link  rel="stylesheet" href="{{asset('catalogo/css/bootstrap.min.css')}}"/>

		<!-- Slick -->
		<link  rel="stylesheet" href="{{asset('catalogo/css/slick.css')}}"/>
		<link  rel="stylesheet" href="{{asset('catalogo/css/slick-theme.css')}}"/>

		<!-- nouislider -->
		<link  rel="stylesheet" href="{{asset('catalogo/css/nouislider.min.css')}}"/>

		<!-- Font Awesome Icon -->
		<link rel="stylesheet" href="{{asset('catalogo/css/font-awesome.min.css')}}">

		<!-- Custom stlylesheet -->
		<link  rel="stylesheet" href="{{asset('catalogo/css/style.css')}}"/>

</head>
<body>
    <div id="app">
        


        <header>
			<!-- TOP HEADER -->
			<div id="top-header">
				<div class="container">
					<ul class="header-links pull-left">
						<li><a href="#"><i class="fa fa-phone"></i> +591-75-51-84-65</a></li>
						<li><a href="#"><i class="fa fa-envelope-o"></i> Eventos@gmail.com</a></li>
						<li><a href="#"><i class="fa fa-map-marker"></i> 1734 UAGRM</a></li>
					</ul>
					<ul class="header-links pull-right ">
						
                        @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                 <a style="color:#008000;" class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); 
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                    
                    
                    </ul>
				</div>
			</div>
			<!-- /TOP HEADER -->

			<!-- MAIN HEADER -->
			<div id="header">
				<!-- container -->
				<div class="container">
					<!-- row -->
					<div class="row">
						<!-- LOGO -->
						<div class="col-md-3">
							<div class="header-logo">
                                <a class="navbar-brand" href="{{ url('/') }}">
                                    {{ config('app.name', 'Laravel') }}
                                </a>
                                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                                    <span class="navbar-toggler-icon"></span>
                                </button>
							</div>
						</div>
						<!-- /LOGO -->

						<!-- SEARCH BAR -->
						<div class="col-md-6">
							<div class="header-search">
								<form>
									<select class="input-select">
										<option value="0">All Categories</option>
										@foreach ($categorias as $categoria)
										<option value="1">{{$categoria->nombre}}</option>
										@endforeach
										</select>
									<input class="input" placeholder="Search here">
									<input type="text" name="user_id" id="user_id" value=" {{ Auth::user()->id }}" hidden="none">
									<button class="search-btn">Search</button>
								</form>
							</div>
						</div>
						<!-- /SEARCH BAR -->

						<!-- ACCOUNT -->
						<div class="col-md-3 clearfix">
							<div class="header-ctn">
								<!-- Wishlist -->
								<div>
								
								</div>
								<!-- /Wishlist -->

								<!-- Cart -->
								<div class="dropdown">
									<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
										<i class="fa fa-shopping-cart"></i>
										<span>Tu Carrito</span>
										
									    	<div class="qty" id="itemrojo">0</div>
									   
									</a>
									<div class="cart-dropdown">
										<div class="cart-list carrito" id="carrito">
											
										</div>
										<input type="text" name="totalitem" id="totalitem" value="0" hidden="none">
										<input type="text" name="total" id="total" value="0" hidden="none">
										<div class="cart-summary" id="carta">
											<small>0 Item(s) Seleccionado</small>
											<h5>SUBTOTAL: Bs.00</h5>
										</div>
										<div class="cart-btns">
										
											<a href="{{route('carrito.create')}}">Ver Detalles  <i class="fa fa-arrow-circle-right"></i></a>
										</div>
									</div>
								</div>
								<!-- /Cart -->

								<!-- Menu Toogle -->
								<div class="menu-toggle">
									<a href="#">
										<i class="fa fa-bars"></i>
										<span>Menu</span>
									</a>
								</div>
								<!-- /Menu Toogle -->
							</div>
						</div>
						<!-- /ACCOUNT -->
					</div>
					<!-- row -->
				</div>
				<!-- container -->
			</div>
			<!-- /MAIN HEADER -->
		</header>
		<!-- /HEADER -->

		<!-- NAVIGATION -->
		<nav id="navigation">
			<!-- container -->
			<div class="container">
				<!-- responsive-nav -->
				<div id="responsive-nav">
					<!-- NAV -->
					<ul class="main-nav nav navbar-nav" style="display: inline">
						<li class="active" value="0"><a data-toggle="tab" class="cargarServicio" href="">Home</a></li>
				@foreach ($servicios as $servicio)
					<li  value="{{$servicio->id}}"><a data-toggle="tab" class="cargarServicio"  href="">{{$servicio->Nombre}}</a></li>
				@endforeach	
				
					</ul>
					<!-- /NAV -->
				
				</div>
				<!-- /responsive-nav -->
			</div>
			<!-- /container -->
		</nav>
		<!-- /NAVIGATION -->





        <main class="py-4">
            @yield('contenido')
        </main>
	</div>
	
	@yield('script')
	<script src="{{ asset('js/servicio/catalogo.js') }}" defer></script>
   
</body>
</html>
