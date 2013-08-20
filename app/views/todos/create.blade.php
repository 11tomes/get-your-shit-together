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
            {{ Form::label('to_be_completed_at', 'To Be Completed At:') }}
            {{ Form::text('to_be_completed_at') }}
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


