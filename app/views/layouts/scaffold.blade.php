<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
		<link href='http://fonts.googleapis.com/css?family=Shadows+Into+Light' rel='stylesheet' type='text/css'>
		<style>
			.handwritten { font-family: 'Shadows Into Light', cursive !important; }
			.handwritten a { color: black !important; }
		</style>
	</head>

	<body>
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
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
	</body>

</html>
