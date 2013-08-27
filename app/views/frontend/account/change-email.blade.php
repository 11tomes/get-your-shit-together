@extends('frontend/layouts/account')

{{-- Page title --}}
@section('title')
Change Your Email
@stop

{{-- Account page content --}}
@section('account-content')
	<form method="post" action="" autocomplete="off" role="form">
		<input type="hidden" name="_token" value="{{ csrf_token() }}" />
		<input type="hidden" name="formType" value="change-email" />
		<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }} ">
			{{ Form::label('email', 'New Email') }}
			{{ Form::text('email', Input::old('email'), array('class' => 'form-control')) }}
			{{ $errors->first('email', '<span class="help-block">:message</span>') }}
		</div>
		<div class="form-group {{ $errors->has('email_confirm') ? 'has-error' : '' }} ">
			{{ Form::label('email_confirm', 'Confirm New Email') }}
			{{ Form::text('email_confirm', NULL, array('class' => 'form-control')) }}
			{{ $errors->first('email_confirm', '<span class="help-block">:message</span>') }}
		</div>
		<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }} ">
			{{ Form::label('current_password', 'Current Password') }}
			{{ Form::password('current_password', array('class' => 'form-control')) }}
			{{ $errors->first('current_password', '<span class="help-block">:message</span>') }}
		</div>
		<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }} ">
			<button type="submit" class="btn btn-primary">Update Email</button>
			<a href="{{ route('forgot-password') }}" class="btn btn-link">I forgot my password</a>
		</div>
	</form>
@stop
