@extends('layouts.scaffold')

@section('title')
	Edit Label
@stop

@section('main')
<div class="row">
<div class="col-xs-12 col-ms-12 col-md-8 col-md-offset-2">
	{{ Form::model($label, array('method' => 'PATCH', 'route' => array('settings.labels.update', $label->id))) }}
		<div class="form-group">
			{{ Form::label('name', 'Name') }}
			{{ Form::text('name', NULL, array('maxlength' => 72, 'class' => 'form-control')) }}
		</div>
		<div class="form-group">
			{{ Form::label('color', 'Color') }}
			<div class="btn-group" data-toggle="buttons">
			@foreach ($colors as $color)
				<label class="btn btn-primary" style="border-color: #{{ $color }}; background-color: #{{ $color }};">
					{{ Form::radio('color', $color) }} <i class="icon-check-sign"></i>
				</label>
			@endforeach
			</div>
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
</div> {{-- .col-* --}}
</div> {{-- .row --}}
@stop
