@extends('layouts.scaffold')

@section('main')

<h1>{{ link_to_route('todos.index', 'Return to all todos', NULL, array('class' => 'btn btn-default')) }} Create Todo</h1>

{{ Form::open(array('route' => 'todos.store')) }}
	<div class="form-group">
		{{ Form::label('todo', 'Todo') }}
		{{ Form::text('todo', $todo, array('class' => 'form-control')) }}
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
		{{ Form::text('order', NULL, array('class' => 'form-control')) }}
	</div>

	<div class="form-group">
		{{ Form::label('labels[]', 'Labels') }}
		{{ Form::select('labels[]', $labels, array(), array('multiple', 'class' => 'form-control')) }}
	</div>

	{{ Form::submit('Add', array('class' => 'btn btn-primary')) }}
{{ Form::close() }}

@if ($errors->any())
	<div class="alert alert-danger">
		{{ implode('', $errors->all('<li class="error">:message</li>')) }}
	</div>
@endif

@stop


