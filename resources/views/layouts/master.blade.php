<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" ng-app="LaravelAngular">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>HZ Competentiemanager - @yield('page-title')</title>
	<link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
  <link href="css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>
  <navigation>
    <nav class="navbar navbar-default navbar-static-top">
      <div class="container-fluid">
          <div class="navbar-header">
              <button aria-controls="navbar" aria-expanded="false" class="navbar-toggle collapsed btn-primary" data-target="#navbar" data-toggle="collapse" type="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="#">
                  <img src="https://hz.nl/assets/svg/hz-logo.svg">
              </a>
          </div>
					<div class="navbar-collapse collapse" id="navbar">
              <ul class="nav navbar-nav">
                <li class="{{ (Request::is('/') ? 'active' : '') }}">
                  <a href="{{ url('') }}"> Welkom</a>
                </li>
								<li class="{{ (Request::is('api') ? 'active' : '') }}">
                  <a href="{{ url('api') }}"> API testing pagina met angularJS</a>
                </li>
								<li class="{{ (Request::is('tasks') ? 'active' : '') }}">
                  <a href="{{ url('tasks') }}"> Crud met angularJS (inloggen vereist)</a>
                </li>
                  <li class="{{ (Request::is('search') ? 'active' : '') }}">
                      <a href="{{ url('search') }}"> Zoekpagina projecten</a>
                  </li>
                  </li>
              </ul>
							<ul class="nav navbar-nav navbar-right">
									<!-- Authentication Links -->
									@guest
											<li><a href="{{ route('login') }}">Login</a></li>
											<li><a href="{{ url('openidconnect') }}">OpenID connect Login</a></li>
											<li><a href="{{ route('register') }}">Registreren</a></li>
									@else
											<li class="dropdown">
													<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
														@if (Auth::user()->picture)
																<p><img src="{{ Auth::user()->picture }}"></p>
														@endif
															{{ Auth::user()->name }} <span class="caret"></span>

													</a>

													<ul class="dropdown-menu">
															<li>
																	<a href="{{ route('logout') }}"
																			onclick="event.preventDefault();
																							 document.getElementById('logout-form').submit();">
																			Logout
																	</a>

																	<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
																			{{ csrf_field() }}
																	</form>
															</li>
													</ul>
											</li>
									@endguest
							</ul>
					</div>
      </div>
  </nav>
</navigation>
<div id="app" class="container-fluid">
    <div class="panel panel-primary">
    <div class="panel-heading">
        @yield('title')
    </div>
    <div class="panel-body">
        @yield('content')
    </div>
</div>
</div>
<footer>
    <div class="container">
        <section class="f-bottom">
            <div class="row">
                <p>
                    <span>Project Competentiemanager - Datamodule. © 2017 HZ University of Applied Sciences</span>
                </p>

            </div>
        </section>
    </div>
</footer>
<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/app.js"></script>
<script> $(document).ready(function() {
    $(".dropdown-toggle").dropdown();
}); </script>

<!-- include additional scripts -->
@yield('scripts')
</body>
</html>
