@extends('frontend/layouts/default')

{{-- Page title --}}
@section('title')
Account Sign in ::
@parent
@stop

@section('styles')
	@parent
	<link href="{{ asset('assets/css/signin.css') }}" rel="stylesheet">
@stop

@section('navigation')
@stop

{{-- Page content --}}
@section('content')
<form method="post" action="{{ route('signin') }}" autocomplete="off" class="form-signin">
	<input type="hidden" name="_token" value="{{ csrf_token() }}" />
	<h2 class="form-signin-heading">Please sign in</h2>
	<input type="text" class="form-control" name="email" id="email" placeholder="Email address" autofocus="" value="{{ Input::old('email') }}">
	<input type="password" class="form-control" name="password" id="password" placeholder="Password">
	<label class="checkbox">
		<input type="checkbox" name="remember-me" id="remember-me" value="1"> Remember me
	</label>
	<button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
</form>
@stop
