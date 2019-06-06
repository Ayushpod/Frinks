<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>{{ config('app.name', 'College Assignement') }}</title>

	<!-- Fonts -->
	<link rel="dns-prefetch" href="//fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
	<!-- Bootstrap CSS CDN -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
	<!-- Our Custom CSS -->
	<!-- Styles -->
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">

	<!-- Font Awesome JS -->
	<script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
	<script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

	<!-- Scripts -->

	<script src="{{ asset('js/app.js') }}" defer></script>
	<link href="{{ asset('css/style.css') }}" rel="stylesheet">
	<style>
		header.masthead {
			position: relative;
			background-color: #343a40;
			/* background: url("./../../public/img/bg-masthead.jpg") no-repeat center center; */
			background-size: cover;
			padding-top: 8rem;
			padding-bottom: 8rem;
		}
	</style>

</head>

<body>
	<!-- <div id="app"> -->
	<!-- Navigation -->

	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<a class="navbar-brand" href="#">Assignement</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div id="navbarNavDropdown" class="navbar-collapse collapse">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item active">
					<a class="nav-link" href="{{route('home')}}">Home
						<span class="sr-only">(current)</span>
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="{{route('about')}}">about</a>
				</li>
				<!-- <li class="nav-item">
                    <a class="nav-link" href="#">Pricing</a>
                </li> -->

			</ul>
			<ul class="navbar-nav">
				@guest

				<li class="nav-item">
					<a class="nav-link" href="{{ url('/login') }}">Login</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="{{ url('/register') }}">Register</a>
				</li>
				@else
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						{{ Auth::user()->name }}
						<span class="caret"></span>
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
						<a class="dropdownitem" href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logoutform').submit();">
							{{ __('Logout') }}
						</a>

						<form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;">
							@csrf
						</form>
					</div>
				</li>
				@endguest
			</ul>
		</div>
	</nav>

	<!-- Masthead -->
	<header class="masthead text-white text-center">
		<div class="overlay"></div>
		<div class="container">
			<div class="row">
				<div class="col-xl-9 mx-auto">
					<h1 class="mb-5">Build a landing page for your business or project and generate more leads!</h1>
				</div>
				<div class="col-md-10 col-lg-8 col-xl-7 mx-auto">
					@if (Request::is('/'))
					<form>
						<div class="form-row align-items-center">
							<div class="col-auto">
								<input type="text" class="form-control mb-2" name="query" id="query" placeholder="Skills">
							</div>
							<div class="col-auto">
								<div class="input-group mb-2">
									<div class="input-group-prepend">
										<div class="input-group-text">By</div>
									</div>
									<input type="text" class="form-control" id="city" name="city" placeholder="By City">
								</div>
							</div>
							<div class="col-auto">
								<button type="submit" class="btn btn-primary mb-2">Search</button>
							</div>
						</div>
					</form>
					@endif
				</div>
			</div>
		</div>
	</header>

	@yield('content')
	<!-- Footer -->
	<footer class="footer bg-light">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 h-100 text-center text-lg-left my-auto">
					<ul class="list-inline mb-2">
						<li class="list-inline-item">
							<a href="{{route('about')}}">About</a>
						</li>
						<li class="list-inline-item">&sdot;</li>
						<li class="list-inline-item">
							<a href="#">Contact</a>
						</li>
						<!-- <li class="list-inline-item">&sdot;</li>
						<li class="list-inline-item">&sdot;</li> -->
						<!-- <li class="list-inline-item">
							<a href="#">Privacy Policy</a>
						</li> -->
					</ul>
					<p class="text-muted small mb-4 mb-lg-0">&copy; Your Website 2019. All Rights Reserved.</p>
				</div>
				<div class="col-lg-6 h-100 text-center text-lg-right my-auto">
					<ul class="list-inline mb-0">
						<li class="list-inline-item mr-3">
							<a href="#">
								<i class="fab fa-facebook fa-2x fa-fw"></i>
							</a>
						</li>
						<li class="list-inline-item mr-3">
							<a href="#">
								<i class="fab fa-twitter-square fa-2x fa-fw"></i>
							</a>
						</li>
						<li class="list-inline-item">
							<a href="#">
								<i class="fab fa-instagram fa-2x fa-fw"></i>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</footer>
	<!-- </div> -->
</body>

</html>