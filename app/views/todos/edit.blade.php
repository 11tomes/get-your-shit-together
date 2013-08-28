@extends('layouts.scaffold')

@section('styles')
	@parent
	{{-- <link rel="stylesheet" type="text/css" media="screen" href="http://tarruda.github.com/bootstrap-datetimepicker/assets/css/bootstrap-datetimepicker.min.css"> --}}
@stop

@section('title')
	Edit Todo
@stop

@section('main')
<div class="row">
<div class="col-xs-12 col-ms-12 col-md-8 col-md-offset-2">
	{{ Form::model($todo, array('method' => 'PATCH', 'route' => array('todos.update', $todo->id))) }}
		<div class="form-group">
			{{ Form::label('todo', 'Todo') }}
			{{ Form::text('todo', NULL, array('class' => 'form-control handwritten', 'maxlength' => 144)) }}
		</div>
		<div class="form-group">
			{{ Form::label('notes', 'Notes (not required)') }}
			{{ Form::textarea('notes', NULL, array('class' => 'form-control', 'rows' => 3, 'maxlength' => 144)) }}
		</div>
		<div class="form-group">
			{{ Form::label('to_be_completed_at', 'To Be Completed At (not required)') }}
			<?php $to_be_completed_at = $todo->to_be_completed_at ? $todo->to_be_completed_at->toDayDateTimeString() : 'someday'; ?>
			{{ Form::input('datetime', 'to_be_completed_at', $to_be_completed_at, array('data-format' => 'MM/dd/yyyy HH:mm:ss PP', 'class' => 'form-control')) }}
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
			{{ Form::label('completed_at', 'Completed At') }}
			<p class="form-control-static">{{ $todo->getDaysTillCompletionDate() }}</p>
		</div>
		<div class="form-group">
			{{ Form::label('labels[]', 'Labels') }}
			{{ Form::select('labels[]', $labels, $todo->selected_labels_ids, array('multiple', 'class' => 'form-control')) }}
		</div>
		<div class="form-group">
			{{ Form::submit('Update', array('class' => 'btn btn-primary')) }}
			{{ link_to_route('todos.index', 'Cancel', NULL, array('class' => 'btn btn-default')) }}
		</div>
	{{ Form::close() }}
	@include('layouts/form_validation')
	<hr>
	<div class="alert alert-danger alert-block">
		<h4>Delete this</h4>
		<p>Deleting a todo is undoable.</p>
		<p>
			{{ Form::open(array('method' => 'DELETE', 'route' => array('todos.destroy', $todo->id))) }}
			{{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
			{{ Form::close() }}
		</p>
	</div>
</div> {{-- .col-* --}}
</div> {{-- .row --}}
@stop

@section('scripts')
	@parent
	{{--
	<script type="text/javascript" src="http://tarruda.github.io/bootstrap-datetimepicker/assets/js/bootstrap-datetimepicker.min.js"></script>
	<script type="text/javascript" src="http://tarruda.github.io/bootstrap-datetimepicker/assets/js/bootstrap-datetimepicker.pt-BR.js"></script>
	<script type="text/javascript">
	$(document).ready(function() {
		$('#to_be_completed_at').datetimepicker({
			language: 'en',
			pick12HourFormat: true
		});
	});
	</script>
	--}}
@stop
