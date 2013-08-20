@extends('layouts.scaffold')

@section('main')

<h1 class="handwritten">All Todos</h1>

<p>{{ link_to_route('todos.create', 'Add new todo', NULL, array('class' => 'btn btn-success')) }}</p>

@if ($todos->count())
	<!--
	@todo move this code
	<ul class="list-group">
	@foreach ($todos as $todo)
		<li class="list-group-item">
		@foreach ($todo->labels as $label)
			<span class="label label-info">{{{ $label->label }}}</span>
		@endforeach
			<span class="handwritten"<?php echo $todo->isDone() ? ' style="text-decoration: line-through;"' : '' ?>>
				{{{ $todo->todo }}}
			</span>
			<div class="pull-right">
			{{ link_to_route('todos.edit', 'Edit', array($todo->id), array('class' => 'btn btn-info')) }}
			</div>
		</li>
	@endforeach
	</ul>
	-->

	<table class="table">
		<tbody>
			@foreach ($todos as $todo)
			<tr>
				<td<?php // @todo echo " style='color: #'{$todo->topPriority->color};"; ?>>{{ Form::checkbox('completed_at', $todo->completed_at, $todo->isDone()); }}</td>
				<td>
				@foreach ($todo->labels as $label)
					<span class="label label-info">{{{ $label->label }}}</span>
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
