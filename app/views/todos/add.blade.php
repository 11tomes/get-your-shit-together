{{ Form::open(array('route' => 'todos.add')) }}
	{{ isset($extra_html) ? $extra_html : '' }}
	{{ Form::text('todo', NULL, array('placeholder' => 'Write a todo', 'class' => 'form-control')) }}
{{ Form::close() }}
