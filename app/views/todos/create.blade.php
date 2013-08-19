@extends('layouts.scaffold')

@section('main')

<h1>Create Todo</h1>

{{ Form::open(array('route' => 'todos.store')) }}
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
			{{ Form::submit('Submit', array('class' => 'btn')) }}
		</li>
	</ul>
{{ Form::close() }}

@if ($errors->any())
	<ul>
		{{ implode('', $errors->all('<li class="error">:message</li>')) }}
	</ul>
@endif

@stop


