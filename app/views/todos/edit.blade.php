@extends('layouts.scaffold')

@section('main')

<h1>{{ link_to_route('todos.index', 'Return to all todos', NULL, array('class' => 'btn btn-default')) }} Edit Todo</h1>

{{ Form::model($todo, array('method' => 'PATCH', 'route' => array('todos.update', $todo->id))) }}
	<div class="form-group">
		{{ Form::label('todo', 'Todo') }}
		{{ Form::text('todo', NULL, array('class' => 'form-control')) }}
	</div>

	<div class="form-group">
		{{ Form::label('notes', 'Notes') }}
		{{ Form::textarea('notes', NULL, array('class' => 'form-control')) }}
	</div>

	<div class="form-group">
		{{ Form::label('to_be_completed_at', 'To Be Completed At') }}
		{{ Form::text('to_be_completed_at', NULL, array('class' => 'form-control')) }}
	</div>

	<div class="form-group">
		{{ Form::label('priority_id', 'Priority') }}
		{{ Form::select('priority_id', $priorities, NULL, array('class' => 'form-control')) }}
	</div>

	<div class="form-group">
		{{ Form::label('order', 'Order') }}
		{{ Form::input('number', 'order', NULL, array('class' => 'form-control')) }}
	</div>

	<div class="form-group">
		{{ Form::label('labels[]', 'Labels') }}
		{{ Form::select('labels[]', $labels, array(), array('multiple', 'class' => 'form-control')) }}
	</div>

	{{ Form::submit('Update', array('class' => 'btn btn-primary')) }}
{{ Form::close() }}

@if ($errors->any())
	<div class="alert alert-info">
		{{ implode('', $errors->all('<li class="error">:message</li>')) }}
	</div>
@endif
<hr>
{{ Form::open(array('method' => 'DELETE', 'route' => array('todos.destroy', $todo->id))) }}
{{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
{{ Form::close() }}

@stop
