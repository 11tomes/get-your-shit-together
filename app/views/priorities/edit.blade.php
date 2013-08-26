@extends('layouts.scaffold')

@section('main')

<h1>Edit Priority</h1>
{{ Form::model($priority, array('method' => 'PATCH', 'route' => array('settings.priorities.update', $priority->id))) }}
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
		{{ Form::text('color', NULL, array('maxlength' => 6, 'class' => 'form-control')) }}
        </div>

        <div class="form-group">
		{{ Form::label('description', 'Description:') }}
		{{ Form::text('description', NULL, array('maxlength' => 144, 'class' => 'form-control')) }}
        </div>

	<div class="form-group">
		{{ Form::submit('Update', array('class' => 'btn btn-primary')) }}
		{{ link_to_route('settings.priorities.show', 'Cancel', $priority->id, array('class' => 'btn')) }}
	</div>
{{ Form::close() }}

@include('layouts/form_validation')

@stop
