<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="robots" content="all,follow">
    <meta name="googlebot" content="index,follow,snippet,archive">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Reserbeer">
    <meta name="author" content="Reserbeer">
    <meta name="keywords" content="beer craft artesanal cerveza biere birra reserbeer reservas bar bares">

    <title>
        Reserbeer
    </title>

    <meta name="keywords" content="">

    <link href='https://fonts.googleapis.com/css?family=Roboto:400,500,700,300,100' rel='stylesheet' type='text/css'>

    <!-- styles -->
    <link href="{{asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{asset('css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{asset('css/bootstrap.css') }}" rel="stylesheet">
	
    <link href="{{asset('css/core-style.css') }}" rel="stylesheet">
    <link href="{{asset('css/responsive.css') }}" rel="stylesheet">

    <link href="{{asset('css/animate.min.css') }}" rel="stylesheet">
    <link href="{{asset('css/owl.carousel.css') }}" rel="stylesheet">
    <link href="{{asset('css/owl.theme.css') }}" rel="stylesheet">

    <!-- theme stylesheet -->
    <!-- <link href="{{asset('css/style.default.css') }}" rel="stylesheet" id="theme-stylesheet"> -->

    <!-- your stylesheet with modifications -->
    <link href="{{asset('css/custom.css') }}" rel="stylesheet">

    <!-- <link rel="shortcut icon" href="{{asset('favicon.png') }}"> -->

    @yield('css')

    <script src="{{asset('js/jquery-2.2.4.min.js') }}"></script>
    <script src="{{asset('js/bootstrap.min.js') }}"></script>

    <script src="{{asset('js/popper.min.js') }}"></script>
    <script src="{{asset('js/plugins.js') }}"></script>
    

    <!-- <script src="{{asset('js/jquery.cookie.js') }}"></script>
    <script src="{{asset('js/waypoints.min.js') }}"></script>
    <script src="{{asset('js/modernizr.js') }}"></script>
    <script src="{{asset('js/bootstrap-hover-dropdown.js') }}"></script>
    <script src="{{asset('js/owl.carousel.min.js') }}"></script>
    <script src="{{asset('js/front.js') }}"></script> -->

    @yield('scripts')
</head>

<?php
$directoryURI = $_SERVER['REQUEST_URI'];
$path = parse_url($directoryURI, PHP_URL_PATH);
$components = explode('/', $path);
$first_part = $components[1];
?>

<body>

<div class="catagories-side-menu">
    <!-- Close Icon -->
    <div id="sideMenuClose">
        <i class="ti-close"></i>
    </div>
    <!--  Side Nav  -->
    <div class="nav-side-menu">
        <div class="menu-list">
            <h6>Cervecerías</h6>
            <ul id="menu-content" class="menu-content collapse out">
                <!-- Single Item -->
                <li data-toggle="collapse" data-target="#women" class="collapsed active">
                    <a href="#">Barrio<span class="arrow"></span></a>
                    <ul class="sub-menu collapse" id="women">
                    
                        <?php $locations = array(); ?>
                        @foreach($sections as $section)
                            @if($section->type == 'home_principal')
                                @foreach($section->sectionEntities as $sectionEntity)
                                    <?php $entidad = $sectionEntity->entity->entidad(); ?>
                                    <?php array_push($locations, $entidad->entity->location); ?>
                                @endforeach
                                <?php $locations = array_unique($locations); ?>
                            @endif
                        @endforeach
                        @foreach($locations as $location)
                            <li><a href="/search/sellerByLocation/{{ $location->id }}">{{ $location->description }}</a></li>
                        @endforeach

                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>

<div id="wrapper">

<!-- *** TOPBAR ***
_________________________________________________________ -->
<div id="top">
    <div class="container">
        <div class="col-md-6 offer" data-animate="fadeInDown">

        </div>
        <div class="col-md-6 offer" data-animate="fadeInDown">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <ul class="menu">
                            <li>
                                Hola, {{ Auth::user()->firstname }}!
                            </li>
                            <li>
                                <a href="{!! url('/myAccount') !!}">Mi cuenta</a>
                            </li>
                            <li>
                                <a href="{!! url('/logout') !!}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Salir</a>
                                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    @else
                        <ul class="menu">
                            <li><a href="#" data-toggle="modal" data-target="#login-modal">Login</a>
                            </li>
                            <li><a href="#" data-toggle="modal" data-target="#register-modal">Registrarse</a>
                            </li>
                        </ul>
                    @endauth
                </div>
            @endif
        </div>
    </div>
    <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="Login" aria-hidden="true">
        <div class="modal-dialog modal-sm">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="Login">Iniciar Sesión</h4>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ url('/loginSite') }}">
                        {!! csrf_field() !!}

                        <div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
                            <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email">
                            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                            @if ($errors->has('email'))
                                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                            @endif
                        </div>

                        <div class="form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
                            <input type="password" class="form-control" placeholder="Password" name="password">
                            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                            @if ($errors->has('password'))
                                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
                            @endif

                        </div>
                        <div class="row" style="margin-bottom:9%;">
                            <div class="col-xs-12">
                                <div class="checkbox icheck">
                                    <label>
                                        <input type="checkbox" name="remember"> Recordarme
                                    </label>
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-xs-12">
                                <button type="submit" class="btn btn-primary btn-block btn-flat">Ingresar</button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>
					<div style="border-top: 1px solid #ccc; padding-top:8px;">
						<strong><a href="{{ url('/password/reset') }}">Olvide mi password</a></strong> 
					</div>
                </div>
            </div>
        </div>
    </div>
	
	
	
	
		
       

        
    <div class="modal fade" id="register-modal" tabindex="-1" role="dialog" aria-labelledby="register" aria-hidden="true">
       
		<div class="modal-dialog modal-sm">

            <div class="modal-content">
			
				<div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="Register">Registrarse</h4>
                </div>
			
				
                
                <div class="modal-body">
                    <form method="post" action="{{ url('/register') }}">
                        {!! csrf_field() !!}

                        <div class="form-group has-feedback{{ $errors->has('firstname') ? ' has-error' : '' }}">
                            <input type="text" class="form-control" name="firstname" value="{{ old('firstname') }}" placeholder="First Name">
                            <span class="glyphicon glyphicon-user form-control-feedback"></span>

                            @if ($errors->has('firstname'))
                                <span class="help-block">
                        <strong>{{ $errors->first('firstname') }}</strong>
                    </span>
                            @endif
                        </div>

                        <div class="form-group has-feedback{{ $errors->has('lastname') ? ' has-error' : '' }}">
                            <input type="text" class="form-control" name="lastname" value="{{ old('lastname') }}" placeholder="Last Name">
                            <span class="glyphicon glyphicon-user form-control-feedback"></span>

                            @if ($errors->has('lastname'))
                                <span class="help-block">
                        <strong>{{ $errors->first('lastname') }}</strong>
                    </span>
                            @endif
                        </div>

                        <div class="form-group has-feedback{{ $errors->has('email') ? ' has-error' : '' }}">
                            <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email">
                            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>

                            @if ($errors->has('email'))
                                <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                            @endif
                        </div>

                        <div class="form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
                            <input type="password" class="form-control" name="password" placeholder="Password">
                            <span class="glyphicon glyphicon-lock form-control-feedback"></span>

                            @if ($errors->has('password'))
                                <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                            @endif
                        </div>

                        <div class="form-group has-feedback{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm password">
                            <span class="glyphicon glyphicon-lock form-control-feedback"></span>

                            @if ($errors->has('password_confirmation'))
                                <span class="help-block">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span>
                            @endif
                        </div>

                        <div class="row">
                            <!-- <div class="col-xs-8">
                                <div class="checkbox icheck">
                                    <label>
                                        <input type="checkbox"> I agree to the <a href="#" style="color: blue;">terms</a>
                                    </label>
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-xs-12" style="margin-top:8px;">
                                <button type="submit" class="btn btn-primary btn-block btn-flat">Registrarse</button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

</div>




    <!-- ****** Header Area Start ****** -->
    <header class="header_area">
        <!-- Top Header Area Start -->
        <div class="top_header_area">
            <div class="container h-100">
                <div class="row h-100 align-items-center justify-content-end">

                    <div class="col-12 col-lg-7">
                        <div class="top_single_area d-flex align-items-center">
                            <!-- Logo Area -->
                            <div class="top_logo">
                                <a href="/"><img src="{{ asset('imagenes/logo.png') }}" alt="" width="95" height="30"></a>
                            </div>
                            <!-- Cart & Menu Area -->
                            <div class="header-cart-menu d-flex align-items-center ml-auto">
                                @if(!empty($order))
                                    <!-- Cart Area -->
                                    <div class="cart">
                                        <?php $cantidadTotalProductos = 0; ?>
                                        @foreach($order->orderDetails as $orderDetail)
                                            <?php $cantidadTotalProductos += $orderDetail->volume; ?>
                                        @endforeach

                                        @if($cantidadTotalProductos > 0)
                                            <a href="#" id="header-cart-btn" target="_blank"><span class="cart_quantity">{{ $cantidadTotalProductos }}</span> <i class="ti-bag"></i> Mi carrito ${{ $orderDetail->total() }}</a>
                                            <!-- Cart List Area Start -->
                                            <ul class="cart-list">
                                                @foreach($order->orderDetails as $orderDetail)
                                                    <li>
                                                        <a href="#" class="image">
                                                            @foreach($orderDetail->product->entity->imageEntities as $imageEntity)
                                                                <img src="{{ asset('imagenes/'.$imageEntity->image->name) }}" class="cart-thumb" width="150px" height="150px">
                                                                <?php break; ?>
                                                            @endforeach
                                                        </a>
                                                            <div class="cart-item-desc">
                                                            <h6><a href="#">{{ $orderDetail->product->name }}</a></h6>
                                                            <p>{{ $orderDetail->volume }} x - <span class="price">${{ $orderDetail->unitPrice() }}</span></p>
                                                        </div>
                                                        <span class="dropdown-product-remove"><i class="icon-cross"></i></span>
                                                    </li>
                                                @endforeach
                                                <li class="total">
                                                    <span class="pull-right">Total: ${{ $orderDetail->total() }}</span>
                                                    <a href="/basket" class="btn btn-sm btn-cart">Ir al carrito</a>
                                                </li>
                                            </ul>
                                        @endif
                                    </div>
                                @endif
                                <div class="header-right-side-menu ml-15">
                                    <a href="#" id="sideMenuBtn"><i class="ti-menu" aria-hidden="true"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Top Header Area End -->
        <div class="main_header_area">
            <div class="container h-100">
                <div class="row h-100">
                    <div class="col-12 d-md-flex justify-content-between">
                        <!-- Header Social Area -->
                        <div class="header-social-area">
                            <a href="#"><span class="karl-level">Share</span> <i class="fa fa-pinterest" aria-hidden="true"></i></a>
                            <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                            <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                            <a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                        </div>
                        <!-- Menu Area -->
                        <div class="main-menu-area">
                            <nav class="navbar navbar-expand-lg align-items-start">

                                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#karl-navbar" aria-controls="karl-navbar" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"><i class="ti-menu"></i></span></button>

                                <div class="collapse navbar-collapse align-items-start collapse" id="karl-navbar">
                                    <ul class="navbar-nav animated" id="nav">
                                        <li class="nav-item active"><a class="nav-link" href="/">Reserbeer</a></li>
                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" href="#" id="karlDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Cervecerías</a>
                                            <div class="dropdown-menu" aria-labelledby="karlDropdown">
                                                @foreach($sections as $section)
                                                    @if($section->type == 'home_principal')
                                                        @foreach($section->sectionEntities as $sectionEntity)
                                                            <?php $entidad = $sectionEntity->entity->entidad(); ?>
                                                            <a class="dropdown-item" href="/{{ $entidad->url() }}/{{ $entidad->id }}">{{ $entidad->title }}</a>
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            </div>
                                        </li>
                                        <li class="nav-item <?php if ($first_part=="location") {echo "active"; } else  {echo "noactive";}?>">
                                            <a class="nav-link" href="/location">Dónde Encontrarnos</a>
                                        </li>
                                        <li class="nav-item <?php if ($first_part=="contact") {echo "active"; } else  {echo "noactive";}?>">
                                            <a class="nav-link" href="/contact"><span class="karl-level">Escribinos</span>Contacto</a>
                                        </li>
                                    </ul>
                                </div>
                            </nav>
                        </div>
                        <!-- Help Line -->
                        <div class="help-line">
                            <a href="tel:+346573556778"><i class="ti-headphone-alt"></i> +34 657 3556 778</a>
                        </div>
                    </div>
                    <div class="col-6 d-md-flex justify-content-between">
                        <div class="navbar-buttons">

                            <div class="navbar-collapse collapse right" id="search-not-mobile">
                                <button type="button" class="btn navbar-btn btn-primary" data-toggle="collapse" data-target="#search">
                                    <span class="sr-only">Toggle search</span>
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>

                        </div>

                        <div class="collapse clearfix" id="search">

                            {{ Form::open(array('id' => 'formulario', 'action' => 'SearchController@globalSearch', 'class' => 'navbar-form', 'role' => 'search')) }}
                            <div class="input-group">
                                {{ Form::text('global_search',null,['class'=>'form-control','name'=>'global_search', 'placeholder'=>'Search']) }}
                                <span class="input-group-btn">
                                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                                        </span>
                            </div>
                            {{ Form::close() }}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- ****** Header Area End ****** -->




    <div id="all">

        <div id="content">
            
            @include('flash::message')
            @yield('content')

        </div>

        <!-- *** FOOTER *** -->
        <div id="footer" data-animate="fadeInUp">

            <div class="container">
                
                <div class="row">
                    
                    <div class="col-md-4 col-sm-6">
                        
                        <h4>Sección Usuarios</h4>

                        <ul>
                            <li>&#8226; <a href="#" data-toggle="modal" data-target="#login-modal" style="color:#4fbfa8;">Iniciar Sesión</a>
                            </li>
                            <li>&#8226; <a href="#" data-toggle="modal" data-target="#register-modal" style="color:#4fbfa8;">Registrarse</a>
                            </li>
                        </ul>

                        <hr class="hidden-md hidden-lg hidden-sm">

                    </div>

                </div>
                <!-- /.row -->

            </div>
            <!-- /.container -->
        </div>
        <!-- /#footer -->

        <!-- *** FOOTER END *** -->




        <!-- *** COPYRIGHT *** -->
        <div id="copyright">
            <div class="container">
                <div class="col-md-6">
                    © 2018 <a href="https://www.reserbeer.com" class="" style="color:#fff !important;" >Reserbeer</a>
                </div>
                <div class="col-md-6">
                    <p class="pull-right">
                        &nbsp;
                    </p>
                </div>
            </div>
        </div>
        <!-- *** COPYRIGHT END *** -->

    </div>




</div>

</body>

<script src="{{asset('js/active.js') }}"></script>

</html>