<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="robots" content="all,follow">
    <meta name="googlebot" content="index,follow,snippet,archive">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Obaju e-commerce template">
    <meta name="author" content="Ondrej Svestka | ondrejsvestka.cz">
    <meta name="keywords" content="">

    <title>

    </title>

    <meta name="keywords" content="">

    <link href='http://fonts.googleapis.com/css?family=Roboto:400,500,700,300,100' rel='stylesheet' type='text/css'>

    <!-- styles -->
    <link href="{{asset('css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{asset('css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{asset('css/bootstrap.css') }}" rel="stylesheet">
	<link href="{{asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{asset('css/animate.min.css') }}" rel="stylesheet">
    <link href="{{asset('css/owl.carousel.css') }}" rel="stylesheet">
    <link href="{{asset('css/owl.theme.css') }}" rel="stylesheet">

    <!-- theme stylesheet -->
    <link href="{{asset('css/style.default.css') }}" rel="stylesheet" id="theme-stylesheet">

    <!-- your stylesheet with modifications -->
    <link href="{{asset('css/custom.css') }}" rel="stylesheet">

    <script src="{{asset('js/respond.min.js') }}"></script>

    <link rel="shortcut icon" href="{{asset('favicon.png') }}">

    @yield('css')

    <!-- jQuery 3.1.1 -->

    <!-- AdminLTE App -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.2/js/adminlte.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/icheck.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

    <!-- Bootstrap 3.3.7 -->
	<!-- alejo <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
    
    <script src="{{asset('js/jquery-1.11.0.min.js') }}"></script>
    <script src="{{asset('js/bootstrap.min.js') }}"></script>
    <script src="{{asset('js/jquery.cookie.js') }}"></script>
    <script src="{{asset('js/waypoints.min.js') }}"></script>
    <script src="{{asset('js/modernizr.js') }}"></script>
    <script src="{{asset('js/bootstrap-hover-dropdown.js') }}"></script>
    <script src="{{asset('js/owl.carousel.min.js') }}"></script>
    <script src="{{asset('js/front.js') }}"></script>

    @yield('scripts')
</head>

<body>

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

<!-- *** TOP BAR END *** -->

<!-- *** NAVBAR ***
_________________________________________________________ -->

<div class="navbar navbar-default yamm" role="navigation" id="navbar">
    <div class="container">
        <div class="navbar-header">

            <a class="navbar-brand home" href="/" data-animate-hover="bounce">
                <img src="{{ asset('img/logo.png') }}" alt="Obaju logo" class="hidden-xs">
                <img src="{{ asset('img/logo-small.png') }}" alt="Obaju logo" class="visible-xs"><span class="sr-only">Obaju - go to homepage</span>
            </a>
            <div class="navbar-buttons">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation">
                    <span class="sr-only">Toggle navigation</span>
                    <i class="fa fa-align-justify"></i>
                </button>
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#search">
                    <span class="sr-only">Toggle search</span>
                    <i class="fa fa-search"></i>
                </button>
                <a class="btn btn-default navbar-toggle" href="basket.html">
                    <i class="fa fa-shopping-cart"></i>  <span class="hidden-xs">3 items in cart</span>
                </a>
            </div>
        </div>
        <!--/.navbar-header -->

        <div class="navbar-collapse collapse" id="navigation">

            <ul class="nav navbar-nav navbar-left">
                <li class="active"><a href="/">Home</a>
                </li>
                <li class="dropdown yamm-fw">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="200">Productos <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <div class="yamm-content">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h5>Categorias</h5>
                                        <ul>
											@foreach($sections as $section)
												@if($section->type == 'home_principal')
													@foreach($section->sectionCategories as $sectionCategory)
															<li class="dropdown yamm-fw">
																<a href="/cat/{!! $sectionCategory->category->id !!}">{!! $sectionCategory->category->description !!}</a>
															</li>
													@endforeach
												@endif
											@endforeach								
										<ul>
									</div>
                                </div>
                            </div>

                        </li>
                    </ul>
                </li>
                <li ><a href="/">Donde Encontrarnos</a>
                </li>
                <li ><a href="/">Contacto</a>
                </li>

            </ul>

        </div>
        <!--/.nav-collapse -->

        <div class="navbar-buttons">

            <div class="navbar-collapse collapse right" id="basket-overview">
                <a href="/basket" class="btn btn-primary navbar-btn"><i class="fa fa-shopping-cart"></i><span class="hidden-sm"></span></a>
            </div>
            <!--/.nav-collapse -->

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
        <!--/.nav-collapse -->

    </div>
    <!-- /.container -->
</div>
<!-- /#navbar -->

<!-- *** NAVBAR END *** -->
<div id="all">

    <div id="content">
        @include('flash::message')
        @yield('content')
    </div>

    <!-- *** FOOTER ***
	
	
_________________________________________________________ -->


	<div id="tarjetas">
			<div class="container">
			
				<div class="col-md-6" style="text-align:right; color:#FFF !important;"><h3>Trabajamos con tarjetas de crédito y débito</h3></div>
				
				<div class="col-md-2"><img src="{{ asset('img/artesaniasenmaderas-visa-electron.jpg') }}" alt="Artesanías en Maderas"> </div>
				
				<div class="col-md-2"><img src="{{ asset('img/artesaniasenmaderas-american-express.jpg') }}" alt="Artesanías en Maderas"></div>
				
				<div class="col-md-2"><img src="{{ asset('img/artesaniasenmaderas-visa.jpg') }}" alt="Artesanías en Maderas"></div>
				
				
			</div>
	</div>
		
		
		
		
    <div id="footer" data-animate="fadeInUp">
	
		
	
	
        <div class="container">
			
			
			
            <div class="row">
				
				
			
			
			
			
			
                <div class="col-md-4 col-sm-6">
                    <!-- h4>Pages</h4>

                    <ul>
                        <li><a href="text.html">About us</a>
                        </li>
                        <li><a href="text.html">Terms and conditions</a>
                        </li>
                        <li><a href="faq.html">FAQ</a>
                        </li>
                        <li><a href="contact.html">Contact us</a>
                        </li>
                    </ul>

                    <hr -->

                    <h4>Sección Usuarios</h4>

                    <ul>
                        <li>&#8226; <a href="#" data-toggle="modal" data-target="#login-modal" style="color:#4fbfa8;">Iniciar Sesión</a>
                        </li>
                        <li>&#8226; <a href="#" data-toggle="modal" data-target="#register-modal" style="color:#4fbfa8;">Registrarse</a>
                        </li>
                    </ul>

                    <hr class="hidden-md hidden-lg hidden-sm">

                </div>
                <!-- /.col-md-3 -->

                <!-- div class="col-md-3 col-sm-6">

                    <h4>Top categories</h4>

                    <h5>Men</h5>

                    <ul>
                        <li><a href="category.html">T-shirts</a>
                        </li>
                        <li><a href="category.html">Shirts</a>
                        </li>
                        <li><a href="category.html">Accessories</a>
                        </li>
                    </ul>

                    <h5>Ladies</h5>
                    <ul>
                        <li><a href="category.html">T-shirts</a>
                        </li>
                        <li><a href="category.html">Skirts</a>
                        </li>
                        <li><a href="category.html">Pants</a>
                        </li>
                        <li><a href="category.html">Accessories</a>
                        </li>
                    </ul>

                    <hr class="hidden-md hidden-lg">

                </div -->
                <!-- /.col-md-3 -->

                <div class="col-md-4 col-sm-6">

                    <h4>Dónde Encontrarnos</h4>

                    <ul>
					<li>&#8226; Italia 461 - (b1648eee)</li>
                    <li>&#8226; Tigre, Buenos Aires, Argentina</li>
					<li>&#8226; Tel: 011-47490453</li>
                    </ul>

                    <!-- a href="contact.html">Pagina de Contacto</a -->

                    <hr class="hidden-md hidden-lg">

                </div>
                <!-- /.col-md-3 -->



                <div class="col-md-4 col-sm-6">

                    <!-- h4>Get the news</h4>

                    <p class="text-muted">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>

                    <form>
                        <div class="input-group">

                            <input type="text" class="form-control">

                                <span class="input-group-btn">

			    <button class="btn btn-default" type="button">Subscribe!</button>

			</span>

                        </div>
                    </form>

                    <hr -->

                    <h4>Mantente en Contacto</h4>

                    <p class="social">
                        <a href="https://www.facebook.com/DIR-Mueblesartesanias-En-Madera-256976744447595/" class="facebook external" data-animate-hover="shake"><i class="fa fa-facebook"></i></a>
                        <a href="https://www.instagram.com/artesaniaenmaderas_/" class="instagram external" data-animate-hover="shake"><i class="fa fa-instagram"></i></a>
                        <a href="mailto:artesaniaenmaderas@hotmail.com" class="email external" data-animate-hover="shake"><i class="fa fa-envelope"></i></a>
                    </p>


                </div>
                <!-- /.col-md-3 -->

            </div>
            <!-- /.row -->

        </div>
        <!-- /.container -->
    </div>
    <!-- /#footer -->

    <!-- *** FOOTER END *** -->




    <!-- *** COPYRIGHT ***
_________________________________________________________ -->
    <div id="copyright">
        <div class="container">
            <div class="col-md-6">
                <!-- <p class="pull-left">© 2018 FAS fas@serugiran.tech</p> -->
				© 2018 <a href="https://www.artesaniasenmaderas.com.ar" class="" style="color:#fff !important;" >Artesanías en Maderas</a>

            </div>
            <div class="col-md-6">
                <p class="pull-right">
                    <!-- Not removing these links is part of the license conditions of the template. Thanks for understanding :) If you want to use the template without the attribution links, you can do so after supporting further themes development at https://bootstrapious.com/donate  -->
                </p>
            </div>
        </div>
    </div>
    <!-- *** COPYRIGHT END *** -->

</div>

</body>
</html>