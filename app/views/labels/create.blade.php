@extends('layouts.scaffold')

@section('main')

<h1>Create Label</h1>

{{ Form::open(array('route' => 'settings.labels.store')) }}
	<ul>
        <li>
            {{ Form::label('label', 'Label:') }}
            {{ Form::text('label') }}
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
            {{ Form::label('parent_id', 'Parent_id:') }}
            {{ Form::text('parent_id') }}
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


