@extends('layouts.scaffold')

@section('title')
	Create Priority
@stop

@section('main')
<div class="row">
<div class="col-xs-12 col-ms-12 col-md-8 col-md-offset-2">
	{{ Form::open(array('route' => 'settings.priorities.store')) }}
		<div class="form-group">
			{{ Form::label('name', 'Name:') }}
			{{ Form::text('name', NULL, array('maxlength' => 1, 'class' => 'form-control')) }}
		</div>
		<div class="form-group">
			{{ Form::label('order', 'Order:') }}
			{{ Form::input('number', 'order', NULL, array('class' => 'form-control')) }}
		</div>
		<div class="form-group">
			{{ Form::label('color', 'Color:') }}
			{{ Form::label('color', 'Color') }}
			<div>
			@foreach ($colors as $color)
				<label class="btn btn-default" style="border-color: #{{ $color }}; background-color: #{{ $color }};">
					{{ Form::radio('color', $color, Input::old('color') == $color ? true : false) }}
				</label>
			@endforeach
			</div>
		</div>
		<div class="form-group">
			{{ Form::label('description', 'Description:') }}
			{{ Form::text('description', NULL, array('maxlength' => 144, 'class' => 'form-control')) }}
		</div>
		<div class="form-group">
			{{ Form::submit('Submit', array('class' => 'btn btn-primary')) }}
		</div>
	{{ Form::close() }}
	@include('layouts/form_validation')
</div> {{-- .col-* --}}
</div> {{-- .row --}}
@stop
