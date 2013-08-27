{{ Form::open(array('route' => 'todos.create', 'method' => 'GET')) }}
	{{ Form::text('todo', NULL, array('placeholder' => 'Write a todo', 'class' => 'form-control')) }}
{{ Form::close() }}
