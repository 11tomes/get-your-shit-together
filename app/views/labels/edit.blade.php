@extends('layouts.scaffold')

@section('main')
<h1>Edit Label</h1>
{{ Form::model($label, array('method' => 'PATCH', 'route' => array('settings.labels.update', $label->id))) }}
        <div class="form-group">
		{{ Form::label('name', 'Name') }}
		{{ Form::text('name', NULL, array('maxlength' => 72, 'class' => 'form-control')) }}
        </div>
        <div class="form-group">
		{{ Form::label('color', 'Color') }}
		{{ Form::text('color', NULL, array('maxlength' => 6, 'class' => 'form-control')) }}
        </div>
        <div class="form-group">
		{{ Form::label('description', 'Description') }}
		{{ Form::textarea('description', NULL, array('maxlength' => 144, 'rows' => 3, 'class' => 'form-control')) }}
	</div>
        <div class="form-group">
		{{ Form::label('parent_id', 'Parent Label') }}
		{{ Form::select('parent_id', $labels, NULL, array('class' => 'form-control')) }}
        </div>
	<div class="form-group">
		{{ Form::submit('Update', array('class' => 'btn btn-primary')) }}
		{{ link_to_route('settings.labels.show', 'Cancel', $label->id, array('class' => 'btn')) }}
	</div>
{{ Form::close() }}
@include('layouts/form_validation')
@stop
