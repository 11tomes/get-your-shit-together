@extends('layouts.scaffold')

@section('main')

<h1>Create Priority</h1>

{{ Form::open(array('route' => 'priorities.store')) }}
	<ul>
        <li>
            {{ Form::label('priority', 'Priority:') }}
            {{ Form::text('priority') }}
        </li>

        <li>
            {{ Form::label('level', 'Level:') }}
            {{ Form::input('number', 'level') }}
        </li>

        <li>
            {{ Form::label('order', 'Order:') }}
            {{ Form::input('number', 'order') }}
        </li>

        <li>
            {{ Form::label('color', 'Color:') }}
            {{ Form::text('color') }}
        </li>

        <li>
            {{ Form::label('description', 'Description:') }}
            {{ Form::text('description') }}
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


