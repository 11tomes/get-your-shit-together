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
            {{ Form::label('to_be_completed_at', 'To Be Completed At:') }}
            {{ Form::text('to_be_completed_at') }}
        </li>

        <li>
            {{ Form::label('priorities[]', 'Priorities:') }}
            {{ Form::select('priorities[]', $priorities, $priorities, array('multiple')) }}
        </li>

        <li>
            {{ Form::label('labels[]', 'Labels:') }}
            {{ Form::select('labels[]', $labels, $labels, array('multiple')) }}
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
