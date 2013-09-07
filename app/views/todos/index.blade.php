@extends('layouts.scaffold')

@section('styles')
	@parent
	<link href="{{ asset('assets/css/shadows.css') }}" rel="stylesheet">
@stop

@section('title')
	{{ $now->toFormattedDateString() }}
@stop

@section('main')
<div class="row"><div class="col-md-12">
<table class="table drop-shadow lifted">
	<tbody>
	@if ($todos->count())
	@foreach ($todos as $todo)
		<tr>
			<td>
			{{ Form::model($todo, array('method' => 'PATCH', 'route' => array('todos.update', $todo->id))) }}
				{{ Form::hidden('completed_at', ($todo->isDone() ? '' : 'now')) }}
				<i class="icon-check{{ $todo->isDone() ? '' : '-empty' }}" onclick="$(this).parents('form').submit();" style="cursor: pointer;"></i>
			{{ Form::close() }}
			</td>
			<td>
				<i class="icon-asterisk" style="color: #{{ $todo->priority->color }};" }}></i>&nbsp;
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
	@endif
		<tr>
			<td></td>
			<td>
				@include('todos/add')
			</td>
			<td></td>
		</tr>
	</tbody>
</table>
</div></div>
@stop
