<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="{{ asset('assets/css/bootstrap.no-icons.min.css') }}" rel="stylesheet">
		<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
		{{-- <link href="{{ asset('assets/css/font-awesome.min.css') }}" rel="stylesheet"> --}}
		<link href="{{ asset('assets/css/Handlee.css') }}" rel="stylesheet">
		<style>
			body, h1 { font-family: 'Handlee', cursive !important; font-weight: 400; }
			.handwritten a { color: black !important; }
		</style>
	</head>

	<body>
		<nav class="navbar navbar-inverse navbar-static-top" role="navigation">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand handwritten" href="http://www.cavemag.com/10-things-you-can-learn-from-suits/">Get Your Sh*t Together</a>
				</div>

				<div class="collapse navbar-collapse">
					<ul class="nav navbar-nav">
						<li>{{ link_to_route('todos.index', 'Today') }}</li>
						<li>{{ link_to_route('todos.labels', 'Labels') }}</li>
					</ul>
				</div>
			</div>
		</nav>

		<div class="container">
			@if (Session::has('alert'))
				<?php list($type, $message) = Session::get('alert'); ?>
				<div class="alert alert-{{{ $type }}} alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					{{{ $message }}}
				</div>
			@endif

			@yield('main')
		</div>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
	</body>

</html>
