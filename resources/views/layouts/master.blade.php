<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>HZ Competentiemanager - @yield('page-title')</title>
	<link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
  <link href="css/bootstrap.min.css" rel="stylesheet" />
	<link href="css/fresh-bootstrap-table.css" rel="stylesheet" />
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
					<a class="navbar-brand navbar-right" href="#">
							<strong> &nbsp; Competentiemanager - Datamodule </strong>
					</a>
					<div class="navbar-collapse collapse" id="navbar">
              <ul class="nav navbar-nav">
                <li class="{{ (Request::is('/') ? 'active' : '') }}">
                  <a href="{{ url('') }}"> Welkom</a>
                </li>
              </ul>
          </div>
      </div>
  </nav>
</navigation>
<div class="container-fluid">
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
<script src="js/bootstrap-table.js"></script>
<!-- include additional scripts -->
@yield('scripts')
</body>
</html>
