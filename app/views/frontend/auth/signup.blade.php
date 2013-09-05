@extends('frontend/layouts/default')

{{-- Page title --}}
@section('title')
Account Sign Up
@stop

@section('styles')
	@parent
	<link href="{{ asset('assets/css/signin.css') }}" rel="stylesheet">
@stop

@section('navigation')
@stop

{{-- Page content --}}
@section('content')
<form method="post" action="{{ route('signup') }}" class="form-signin">
	<input type="hidden" name="_token" value="{{ csrf_token() }}" />
	<input type="hidden" name="country" id="country" />
	<h2 class="form-signin-heading">Sign Up</h2>
	{{ Form::text('email', Input::old('email'), array('placeholder' => 'Your email address', 'class' => 'form-control')) }}
	{{ $errors->first('email', '<span class="help-block">:message</span>') }}
	{{ Form::password('password', array('placeholder' => 'Choose a password', 'class' => 'form-control')) }}
	{{ $errors->first('password', '<span class="help-block">:message</span>') }}
	<button class="btn btn-lg btn-primary btn-block" type="submit">Sign up</button>
</form>
@stop

@section('scripts')
	<script src="//cdnjs.cloudflare.com/ajax/libs/jstimezonedetect/1.0.4/jstz.min.js"></script>
	<script>
		$(document).ready(function () {
			var tz = jstz.determine();
			$('#country').val(tz.name());
		});
	</script>
@stop
