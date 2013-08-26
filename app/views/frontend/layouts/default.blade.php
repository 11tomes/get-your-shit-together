<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>
			@section('title')
			@show
			:: Git Your Sh*t Together
		</title>
		<meta name="keywords" content="your, awesome, keywords, here" />
		<meta name="author" content="Jon Doe" />
		<meta name="description" content="Lorem ipsum dolor sit amet, nihil fabulas et sea, nam posse menandri scripserit no, mei." />
		{{-- Mobile Specific Metas --}}
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		{{-- Basic Stylesheets --}}
		<link href="{{ asset('assets/css/bootstrap.no-icons.min.css') }}" rel="stylesheet">
		<link href="{{ asset('assets/css/Handlee.css') }}" rel="stylesheet">
		<style>
			body, h1 { font-family: 'Handlee', cursive !important; font-weight: 400; }
			.handwritten a { color: black !important; }
		</style>
		{{-- Additional Stylesheets --}}
		@section('styles')
		@show

		<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
		<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->

		{{-- Favicons @todo update these --}}
		<link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ asset('assets/ico/apple-touch-icon-144-precomposed.png') }}">
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ asset('assets/ico/apple-touch-icon-114-precomposed.png') }}">
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ asset('assets/ico/apple-touch-icon-72-precomposed.png') }}">
		<link rel="apple-touch-icon-precomposed" href="{{ asset('assets/ico/apple-touch-icon-57-precomposed.png') }}">
		<link rel="shortcut icon" href="{{ asset('assets/ico/favicon.png') }}">
	</head>

	<body>
		<div class="container">
			@section('navigation')
			{{--
			<div class="navbar navbar-inverse">
				<div class="navbar-inner">
					<div class="container">
						<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</a>

						<div class="nav-collapse collapse">
							<ul class="nav">
								<li {{ (Request::is('/') ? 'class="active"' : '') }}><a href="{{ route('home') }}"><i class="icon-home icon-white"></i> Home</a></li>
								<li {{ (Request::is('about-us') ? 'class="active"' : '') }}><a href="{{ URL::to('about-us') }}"><i class="icon-file icon-white"></i> About us</a></li>
								<li {{ (Request::is('contact-us') ? 'class="active"' : '') }}><a href="{{ URL::to('contact-us') }}"><i class="icon-file icon-white"></i> Contact us</a></li>
							</ul>

							<ul class="nav pull-right">
								@if (Sentry::check())

								<li class="dropdown{{ (Request::is('account*') ? ' active' : '') }}">
									<a class="dropdown-toggle" id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="{{ route('account') }}">
										Welcome, {{ Sentry::getUser()->first_name }}
										<b class="caret"></b>
									</a>
									<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
										<li{{ (Request::is('account/profile') ? ' class="active"' : '') }}><a href="{{ route('profile') }}"><i class="icon-user"></i> Your profile</a></li>
										<li class="divider"></li>
										<li><a href="{{ route('logout') }}"><i class="icon-off"></i> Logout</a></li>
									</ul>
								</li>
								@else
								<li {{ (Request::is('auth/signin') ? 'class="active"' : '') }}><a href="{{ route('signin') }}">Sign in</a></li>
								<li {{ (Request::is('auth/signup') ? 'class="active"' : '') }}><a href="{{ route('signup') }}">Sign up</a></li>
								@endif
							</ul>
						</div>
					</div>
				</div>
			</div>
			--}}
			@show

			{{-- Notifications --}}
			@include('frontend/notifications')

			{{-- Content --}}
			@yield('content')

			<hr />

			<footer>
				{{-- <p>&copy; Git Your Sh*t Together {{ date('Y') }}</p> --}}
			</footer>
		</div>

		{{-- Basic Scripts --}}
		<script src="{{ asset('assets/js/jquery.1.10.2.min.js') }}"></script>
		<script src="{{ asset('assets/js/bootstrap/bootstrap.min.js') }}"></script>
		@section('scripts')
		@show
	</body>
</html>
