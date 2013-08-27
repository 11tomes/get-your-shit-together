<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>
		@section('title')
		@show
		| Get Your Sh*t Together
	</title>
	<meta name="keywords" content="your, awesome, keywords, here" />
	<meta name="author" content="Jon Doe" />
	<meta name="description" content="Lorem ipsum dolor sit amet, nihil fabulas et sea, nam posse menandri scripserit no, mei." />
	{{-- Mobile Specific Metas --}}
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	{{-- Basic Stylesheets --}}
	<link href="{{ asset('assets/css/bootstrap.no-icons.min.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/css/font-awesome.min.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/css/handlee.css') }}" rel='stylesheet' type='text/css'>
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
		<nav role="navigation" class="navbar navbar-default">
			<div class="navbar-header">
				<button data-target=".navbar-ex1-collapse" data-toggle="collapse" class="navbar-toggle" type="button">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a href="#" class="navbar-brand">
				@section('title')
					Get Your Sh*t Together
				@show
				</a>
			</div>
			<div class="collapse navbar-collapse navbar-ex1-collapse">
				@include('frontend/navigation')
			</div>
		</nav>
		@show

		{{-- Notifications --}}
		@include('frontend/notifications')

		{{-- Content --}}
		@yield('content')

		<footer>
			{{-- <p>&copy; Get Your Sh*t Together {{ date('Y') }}</p> --}}
		</footer>
	</div>

	{{-- Basic Scripts --}}
	<script src="{{ asset('assets/js/jquery.1.10.2.min.js') }}"></script>
	<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
	@section('scripts')
	@show
</body>
</html>
