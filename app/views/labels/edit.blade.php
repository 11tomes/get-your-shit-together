@extends('layouts.scaffold')

@section('main')

<h1>Edit Label</h1>
{{ Form::model($label, array('method' => 'PATCH', 'route' => array('settings.labels.update', $label->id))) }}
	<ul>
        <li>
            {{ Form::label('label', 'Label') }}
            {{ Form::text('label') }}
        </li>

        <li>
            {{ Form::label('color', 'Color') }}
            {{ Form::text('color') }}
        </li>

        <li>
            {{ Form::label('description', 'Description') }}
            {{ Form::text('description') }}
        </li>

        <li>
            {{ Form::label('parent_id', 'Parent') }}
            {{ Form::select('parent_id', $labels) }}
        </li>

		<li>
			{{ Form::submit('Update', array('class' => 'btn btn-info')) }}
			{{ link_to_route('settings.labels.show', 'Cancel', $label->id, array('class' => 'btn')) }}
		</li>
	</ul>
{{ Form::close() }}

@if ($errors->any())
	<ul>
		{{ implode('', $errors->all('<li class="error">:message</li>')) }}
	</ul>
@endif

@stop
