<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>
		@section('title') 
		@show | Get Your Sh*t Together
	</title>
	<meta name="keywords" content="your, awesome, keywords, here" />
	<meta name="author" content="Jon Doe" />
	<meta name="description" content="Lorem ipsum dolor sit amet, nihil fabulas et sea, nam posse menandri scripserit no, mei." />
	{{-- Mobile Specific Metas --}}
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	{{-- Basic Stylesheets --}}
	<link href="{{ asset('assets/css/css.css') }}" rel="stylesheet">
	<style>
		.handwritten a { color: black !important; }
		.container { margin-top: 60px; }
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
<body style="display: none;">
	@section('navigation')
	<nav role="navigation" class="navbar navbar-default navbar-fixed-top">
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
	<div class="container">

		{{-- Notifications --}}
		@include('frontend/notifications')

		{{-- Content --}}
		@yield('content')

		<footer>
			{{-- <p>&copy; Get Your Sh*t Together {{ date('Y') }}</p> --}}
		</footer>
	</div>

	{{-- Basic Scripts --}}
	<script src="{{ asset('assets/js/js.js') }}"></script>
	{{--
	<script type="text/javascript">
		// Add a script element as a child of the body
		function downloadJSAtOnload() {
			var element = document.createElement("script");
			element.src = "js.js";
			document.head.appendChild(element);
		}
		// Check for browser support of event handling capability
		if (window.addEventListener)
			window.addEventListener("load", downloadJSAtOnload, false);
		else if (window.attachEvent)
			window.attachEvent("onload", downloadJSAtOnload);
		else 
			window.onload = downloadJSAtOnload;
	</script>
	--}}
	<script type="text/javascript">
		$(document).ready(function() {
			$('body').show();
		});
	</script>
	@section('scripts')
	@show
</body>
</html>
