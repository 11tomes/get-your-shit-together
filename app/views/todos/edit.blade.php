@extends('layouts.scaffold')

@section('main')

<h1>Edit Todo</h1>
{{ Form::model($todo, array('method' => 'PATCH', 'route' => array('todos.update', $todo->id))) }}
	<ul>
        <li>
            {{ Form::label('todo', 'Todo:') }}
            {{ Form::text('todo') }}
        </li>

        <li>
            {{ Form::label('notes', 'Notes:') }}
            {{ Form::text('notes') }}
        </li>

        <li>
            {{ Form::label('deadline', 'Deadline:') }}
            {{ Form::text('deadline') }}
        </li>

        <li>
            {{ Form::label('done_on', 'Done_on:') }}
            {{ Form::text('done_on') }}
        </li>

		<li>
			{{ Form::submit('Update', array('class' => 'btn btn-info')) }}
			{{ link_to_route('todos.show', 'Cancel', $todo->id, array('class' => 'btn')) }}
		</li>
	</ul>
{{ Form::close() }}

@if ($errors->any())
	<ul>
		{{ implode('', $errors->all('<li class="error">:message</li>')) }}
	</ul>
@endif

@stop