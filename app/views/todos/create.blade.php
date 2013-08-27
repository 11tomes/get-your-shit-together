@extends('layouts.scaffold')

@section('title')
	Add Todo
@stop

@section('main')
<div class="row">
<div class="col-xs-12 col-ms-12 col-md-8 col-md-offset-2">
	{{ Form::open(array('route' => 'todos.store')) }}
		<div class="form-group">
			{{ Form::label('todo', 'Todo') }}
			{{ Form::text('todo', $todo, array('class' => 'form-control')) }}
		</div>
		<div class="form-group">
			{{ Form::label('notes', 'Notes (not required)') }}
			{{ Form::textarea('notes', NULL, array('class' => 'form-control', 'rows' => 3)) }}
		</div>
		<div class="form-group">
			{{ Form::label('to_be_completed_at', 'To Be Completed At (not required)') }}
			{{ Form::text('to_be_completed_at', NULL, array('class' => 'form-control')) }}
		</div>
		<div class="form-group">
			{{ Form::label('priority_id', 'Priority') }}
			{{ Form::select('priority_id', $priorities, NULL, array('class' => 'form-control')) }}
		</div>
		<div class="form-group">
			{{ Form::label('order', 'Place After') }}
			{{ Form::select('order', $todos, NULL, array('class' => 'form-control')) }}
		</div>
		<div class="form-group">
			{{ Form::label('labels[]', 'Labels') }}
			{{ Form::select('labels[]', $labels, array(), array('multiple', 'class' => 'form-control')) }}
		</div>
		{{ Form::submit('Add', array('class' => 'btn btn-primary')) }}
	{{ Form::close() }}
	@include('layouts/form_validation')
</div> {{-- .col-* --}}
</div> {{-- .row --}}
@stop
