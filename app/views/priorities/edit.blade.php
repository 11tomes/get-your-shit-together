@extends('layouts.scaffold')

@section('main')

<h1>Edit Priority</h1>
{{ Form::model($priority, array('method' => 'PATCH', 'route' => array('settings.priorities.update', $priority->id))) }}
	<ul>
        <li>
            {{ Form::label('priority', 'Priority:') }}
            {{ Form::text('priority') }}
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
			{{ Form::submit('Update', array('class' => 'btn btn-info')) }}
			{{ link_to_route('settings.priorities.show', 'Cancel', $priority->id, array('class' => 'btn')) }}
		</li>
	</ul>
{{ Form::close() }}

@if ($errors->any())
	<ul>
		{{ implode('', $errors->all('<li class="error">:message</li>')) }}
	</ul>
@endif

@stop
