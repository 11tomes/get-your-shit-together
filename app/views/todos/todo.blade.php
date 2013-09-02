<li class="list-group-item">
	<span class="handwritten"{{ $todo->isDone() ? ' style="text-decoration: line-through;"' : '' }}>
		{{ link_to_route('todos.edit', $todo->todo, array($todo->id)) }}
	</span>
</li>
