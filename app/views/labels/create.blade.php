@extends('layouts.scaffold')

@section('main')
<h1>Create Label</h1>
{{ Form::open(array('route' => 'settings.labels.store')) }}
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
		{{ Form::submit('Submit', array('class' => 'btn btn-primary')) }}
	</div>
{{ Form::close() }}
@include('layouts/form_validation')
@stop
