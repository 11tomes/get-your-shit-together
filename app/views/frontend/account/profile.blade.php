@extends('frontend/layouts/account')

{{-- Page title --}}
@section('title')
Your Profile
@stop

@section('navigation')
@show

{{-- Account page content --}}
@section('account-content')
<div class="page-header">
	<h4>Update your Profile</h4>
</div>

<form method="post" action="" autocomplete="off">
	<input type="hidden" name="_token" value="{{ csrf_token() }}" />
	<div class="form-group{{ $errors->first('first_name', ' has-error') }}">
		{{ Form::label('first_name', 'First Name') }}
		{{ Form::text('first_name', Input::old('first_name', $user->first_name), array('class' => 'form-control')) }}
		{{ $errors->first('first_name', '<span class="help-block">:message</span>') }}
	</div>
	<div class="form-group{{ $errors->first('last_name', ' has-error') }}">
		{{ Form::label('last_name', 'Last Name') }}
		{{ Form::text('last_name', Input::old('last_name', $user->last_name), array('class' => 'form-control')) }}
		{{ $errors->first('last_name', '<span class="help-block">:message</span>') }}
	</div>
	<div class="form-group{{ $errors->first('website', ' has-error') }}">
		{{ Form::label('website', 'Website URL') }}
		{{ Form::input('url', 'website', Input::old('website', $user->website), array('class' => 'form-control')) }}
		{{ $errors->first('website', '<span class="help-block">:message</span>') }}
	</div>
	<div class="form-group{{ $errors->first('country', ' has-error') }}">
		{{ Form::label('country', 'Country') }}
		{{ Form::text('country', Input::old('country', $user->country), array('class' => 'form-control')) }}
		{{ $errors->first('country', '<span class="help-block">:message</span>') }}
	</div>
	<div class="form-group{{ $errors->first('gravatar', ' has-error') }}">
		{{ Form::label('gravatar', 'Gravatar Email (Private)') }}
		{{ Form::text('gravatar', Input::old('gravatar', $user->gravatar), array('class' => 'form-control')) }}
		{{ $errors->first('gravatar', '<span class="help-block">:message</span>') }}
		<label>
			<img src="//secure.gravatar.com/avatar/{{ md5(strtolower(trim($user->gravatar))) }}" width="30" height="30" />
			<a href="http://gravatar.com">Change your avatar at Gravatar.com</a>
		</label>
	</div>
	<div class="form-group">
		<button type="submit" class="btn btn-primary">Update your Profile</button>
	</div>
</form>
@stop
