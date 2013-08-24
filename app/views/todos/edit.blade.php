@extends('layouts.scaffold')

@section('styles')
	@parent
	<!-- 
	<link rel="stylesheet" type="text/css" media="screen" href="http://tarruda.github.com/bootstrap-datetimepicker/assets/css/bootstrap-datetimepicker.min.css">
	-->
@stop

@section('main')

<h1>{{ link_to_route('todos.index', 'Return to all todos', NULL, array('class' => 'btn btn-default')) }} Edit Todo</h1>

{{ Form::model($todo, array('method' => 'PATCH', 'route' => array('todos.update', $todo->id))) }}
	<div class="form-group">
		{{ Form::label('todo', 'Todo') }}
		{{ Form::text('todo', NULL, array('class' => 'form-control handwritten')) }}
	</div>

	<div class="form-group">
		{{ Form::label('notes', 'Notes') }}
		{{ Form::textarea('notes', NULL, array('class' => 'form-control handwritten')) }}
	</div>

	<div class="form-group">
		{{ Form::label('to_be_completed_at', 'To Be Completed At') }}
		<div id="datetimepicker2" class="input-append">
			{{ Form::text('to_be_completed_at', NULL, array('data-format' => 'MM/dd/yyyy HH:mm:ss PP', 'class' => 'form-control')) }}
			<span class="add-on">
				<i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
			</span>
		</div>
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
		{{ Form::select('labels[]', $labels, $todo->selected_labels_ids, array('multiple', 'class' => 'form-control')) }}
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

@section('scripts')
	@parent
	<!--
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
	-->
@stop
