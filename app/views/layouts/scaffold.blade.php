@extends('frontend/layouts/default')

@section('styles')
<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
{{-- <link href="{{ asset('assets/css/font-awesome.min.css') }}" rel="stylesheet"> --}}
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
