@extends('layouts.scaffold')

@section('main')

<h1 class="handwritten">All Todos</h1>

<p>{{ link_to_route('todos.create', 'Add new todo', NULL, array('class' => 'btn btn-success')) }}</p>

@if ($todos->count())
	<table class="table">
		<tbody>
			@foreach ($todos as $todo)
			<tr>
				<td<?php echo " style='background-color: #{$todo->priority->color}';"; ?>>{{ Form::checkbox('completed_at', $todo->completed_at, $todo->isDone()); }}</td>
				<td>
				@foreach ($todo->labels as $label)
					<span class="label" style="background: #{{{ $label->color }}} !important;">{{{ $label->label }}}</span>
				@endforeach
					<span class="handwritten"<?php echo $todo->isDone() ? ' style="text-decoration: line-through;"' : '' ?>>
						{{ link_to_route('todos.edit', $todo->todo, array($todo->id)) }}
					</span>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
@else
	There are no todos
@endif

@stop
