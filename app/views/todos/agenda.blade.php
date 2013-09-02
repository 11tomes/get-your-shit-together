@extends('layouts.scaffold')

@section('styles')
	@parent
	<link href="{{ asset('assets/css/shadows.css') }}" rel="stylesheet">
@stop

@section('title')
	View: Agenda
@stop

@section('main')
@foreach ($completion_dates as $date)
<?php $todos = Todo::findByCompletionDate($date); ?>
<div class="col-md-8 col-md-offset-2">
	<div class="panel panel-default drop-shadow lifted" style="padding: 0 !important;">
		<div class="panel-heading">
			{{{ $date ? $date->toFormattedDateString() : 'Someday' }}}&nbsp;<span class="badge">{{{ count($todos)  }}}</span>
		</div>
		<ul class="list-group">
		@foreach ($todos as $todo)
			@include('todos/todo')
		@endforeach
			<li class="list-group-item">
				<?php $extra_html = Form::hidden('to_be_completed_at', $date); ?>
				@include('todos/add')
			</li>
		</ul>
	</div>
</div>
@endforeach
@stop
