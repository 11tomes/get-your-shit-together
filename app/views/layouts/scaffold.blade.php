@extends('frontend/layouts/default')

@section('styles')
	<link href="{{ asset('assets/css/handlee.css') }}" rel='stylesheet' type='text/css'>
	<link href="{{ asset('assets/css/font-awesome.min.css') }}" rel="stylesheet">
	<style>
		body, h1 { font-family: 'Handlee', cursive !important; font-weight: 400; }
		.handwritten a { color: black !important; }
	</style>
@stop

@section('content')
@if (Session::has('alert'))
	<?php list($type, $message) = Session::get('alert'); ?>
	<div class="alert alert-{{{ $type }}} alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		{{{ $message }}}
	</div>
@endif
	@yield('main')
@stop
