@extends('layouts.scaffold')

@section('styles')
	@parent
	<link href="{{ asset('assets/css/shadows.css') }}" rel="stylesheet">
@stop

@section('navigation')
@stop

@section('main')
<div class="row drop-shadow lifted">
<div class="col-md-9">
	<h1 class="pull-left handwritten">{{ $now->toFormattedDateString() }}</h1>
</div>
<div class="col-md-3">
	<div class="pull-right">
		@include('frontend/navigation')
	</div>
</div>

@if ($todos->count())
<table class="table">
	<tbody>
	@foreach ($todos as $todo)
		<tr>
			<td>
				<i class="icon-asterisk" style="color: #{{ $todo->priority->color }};" }}></i>&nbsp;
			</td>
			<td>
			{{ Form::model($todo, array('method' => 'PATCH', 'route' => array('todos.update', $todo->id))) }}
				{{ Form::hidden('completed_at', ($todo->isDone() ? '' : $now)) }}
				<i class="icon-check{{ $todo->isDone() ? '' : '-empty' }}" onclick="$(this).parents('form').submit();" style="cursor: pointer;"></i>
			{{ Form::close() }}
			</td>
			<td>
			@foreach ($todo->labels as $label)
				<span class="label" style="background: #{{{ $label->color }}};">{{{ $label->complete_name }}}</span>
			@endforeach
				<span class="handwritten"<?php echo $todo->isDone() ? ' style="text-decoration: line-through;"' : '' ?>>
					{{ link_to_route('todos.edit', $todo->todo, array($todo->id)) }}
				</span>
			</td>
			<td class="handwritten">{{{ $todo->getDaysTillCompletionDate() }}}</td>
		</tr>
	@endforeach
		<tr>
		{{ Form::open(array('route' => 'todos.create', 'method' => 'GET')) }}
			<td></td>
			<td></td>
			<td>
				{{ Form::text('todo', NULL, array('placeholder' => 'Write a todo', 'class' => 'form-control')) }}
			</td>
			<td>
				{{ Form::submit('Add', array('class' => 'btn btn-primary')) }}
			</td>
		{{ Form::close() }}
		</tr>
	</tbody>
</table>
@else
	{{ link_to_route('todos.create', 'Do something now!', array(), array('class' => 'btn btn-primary')) }}
@endif
</div>
@stop
