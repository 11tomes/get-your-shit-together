@extends('layouts.scaffold')

@section('main')
<?php // @todo refactor ?>
<script>
$(document).ready(function() {
	var $mark_as_completed = $('#mark_as_completed');
	var $completed_at = $('#completed_at');
	$mark_as_completed.click(function () {
		$completed_at.prop('readonly', $mark_as_completed.is(':checked'));

		$mark_as_completed.parents('form').submit();
	});
});
</script>
<h1 class="handwritten">All Todos</h1>

<p>{{ link_to_route('todos.create', 'Add new todo', NULL, array('class' => 'btn btn-success')) }}</p>

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
				<span class="label" style="background: #{{{ $label->color }}} !important;">{{{ $label->complete_label }}}</span>
			@endforeach
				<span class="handwritten"<?php echo $todo->isDone() ? ' style="text-decoration: line-through;"' : '' ?>>
					{{ link_to_route('todos.edit', $todo->todo, array($todo->id)) }}
				</span>
			</td>
			<td class="handwritten">{{{ $todo->getDaysTillCompletionDate() }}}</td>
		</tr>
	@endforeach
	</tbody>
</table>
@else
	There are no todos
@endif

@stop
