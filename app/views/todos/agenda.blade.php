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
<?php $todos = Todo::findByCompletionDate($date->to_be_completed_at); /*highlight_string(var_export($todos, TRUE)); die();*/ ?>
<div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-4 col-lg-offset-4">
	<div class="panel panel-default drop-shadow lifted" style="padding: 0 !important;">
		<div class="panel-heading">
			{{{ $date->to_be_completed_at ? $date->to_be_completed_at->toFormattedDateString() : 'Someday' }}}&nbsp;<span class="badge">{{{ count($todos)  }}}</span>
		</div>
		<ul class="list-group">
		@foreach ($todos as $todo)
			<li class="list-group-item">
				<i class="icon-check{{ $todo->isDone() ? '' : '-empty' }}"></i>
				<span class="handwritten"{{ $todo->isDone() ? ' style="text-decoration: line-through;"' : '' }}>
					{{{ $todo->todo }}}
				</span>
			</li>
		@endforeach
		</ul>
	</div>
</div>
@endforeach
@stop
