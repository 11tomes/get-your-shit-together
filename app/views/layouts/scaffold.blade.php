@extends('frontend/layouts/default')

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
