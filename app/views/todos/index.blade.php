@extends('layouts.scaffold')

@section('main')
<h1 class="handwritten">All Todos</h1>

@if ($todos->count())
<table class="table">
	<tbody>
	@foreach ($todos as $todo)
		<tr>
			<td{{ " style='border-left: 10px solid #{$todo->priority->color}';" }}>
			{{ Form::model($todo, array('method' => 'PATCH', 'route' => array('todos.update', $todo->id))) }}
				{{ Form::hidden('completed_at', ($todo->isDone() ? '' : $now)) }}
				{{ Form::button('<i class="icon-check' . ($todo->isDone() ? '' : '-empty') . '"></i>', array('type' => 'submit', 'class' => 'btn btn-default')) }}
			{{ Form::close() }}
			</td>
			<td>
			@foreach ($todo->labels as $label)
				<span class="label" style="background: #{{{ $label->color }}};">{{{ $label->complete_label }}}</span>
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
			<td style="border-left: 10px solid #ffffff;">
				{{ Form::button('<i class="icon-check-empty"></i>', array('type' => 'button', 'disabled' => 'disabled', 'class' => 'btn btn-default')) }}
			</td>
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
	There are no todos
@endif

@stop
