@extends('frontend/layouts/default')

{{-- Page title --}}
@section('title')
Account Sign up ::
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
<form method="post" action="{{ route('signup') }}" autocomplete="off" class="form-signin">
	<input type="hidden" name="_token" value="{{ csrf_token() }}" />
	<h2 class="form-signin-heading">Sign Up</h2>
@foreach (array('first_name', 'last_name', 'email', 'email_confirm') as $text_field)
	{{ Form::text($text_field, Input::old($text_field), array('placeholder' => ucwords(str_replace('_', ' ', $text_field)), 'class' => 'form-control')) }}
	{{ Form::label('') }}
@endforeach
@foreach (array('password', 'password_confirm') as $password_field)
	{{ Form::password($password_field, array('placeholder' => ucwords(str_replace('_', ' ', $password_field)), 'class' => 'form-control')) }}
@endforeach
	<button class="btn btn-lg btn-primary btn-block" type="submit">Sign up</button>
</form>
@stop
