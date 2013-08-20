@extends('layouts.scaffold')

@section('main')

<h1>All Todos</h1>

<p>{{ link_to_route('todos.create', 'Add new todo') }}</p>

@if ($todos->count())
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th></th>
				<th>Todo</th>
				<th>Notes</th>
				<th>To Be Completed At</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($todos as $todo)
			<tr>
				<td<?php // @todo echo " style='color: #'{$todo->topPriority->color};"; ?>>{{ Form::checkbox('completed_at', $todo->completed_at, $todo->isDone()); }}</td>
				<td>
				@foreach ($todo->labels as $label)
					<span class="label label-info">{{{ $label->label }}}</span>
				@endforeach
					<span class="handwritten"<?php echo $todo->isDone() ? ' style="text-decoration: line-through;"' : '' ?>>
						{{{ $todo->todo }}}
					</span>
				</td>
				<td class="handwritten">{{{ $todo->notes }}}</td>
				<td class="handwritten">{{ $todo->to_be_completed_at ? $todo->getDaysTillCompletionDate() : NULL }}</td>
				<td>{{ link_to_route('todos.edit', 'Edit', array($todo->id), array('class' => 'btn btn-info')) }}</td>
				<td>
					{{ Form::open(array('method' => 'DELETE', 'route' => array('todos.destroy', $todo->id))) }}
					{{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
					{{ Form::close() }}
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
@else
	There are no todos
@endif

@stop
