<li class="list-group-item">
	{{ Form::model($todo, array('method' => 'PATCH', 'route' => array('todos.update', $todo->id))) }}
		{{ Form::hidden('completed_at', ($todo->isDone() ? '' : 'now')) }}
		<i class="icon-check{{ $todo->isDone() ? '' : '-empty' }}" onclick="$(this).parents('form').submit();" style="cursor: pointer;"></i>
		<span class="handwritten"{{ $todo->isDone() ? ' style="text-decoration: line-through;"' : '' }}>
			{{ link_to_route('todos.edit', $todo->todo, array($todo->id)) }}
		</span>
	{{ Form::close() }}
</li>
