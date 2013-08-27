@extends('layouts.scaffold')

@section('title')
Labels
@stop

@section('main')
<p>{{ link_to_route('settings.labels.create', 'Add new label') }}</p>
@if ($labels->count())
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th></th>
				<th>Name</th>
				<th>Preview</th>
				<th>Description</th>
				<th>Parent</th>
				<th></th>
			</tr>
		</thead>

		<tbody>
		@foreach ($labels as $label)
			<tr>
				<td>
					{{ Form::open(array('method' => 'DELETE', 'route' => array('settings.labels.destroy', $label->id))) }}
					{{ Form::button('<i class="icon-trash"></i>', array('type' => 'submit', 'class' => 'btn btn-danger')) }}
					{{ Form::close() }}
				</td>
				<td>{{{ $label->name }}}</td>
				<td><span class="label" style="background: #{{{ $label->color }}};">{{{ $label->complete_name }}}</span></td>
				<td>{{{ $label->description }}}</td>
				<td>{{{ $label->parent ? $label->parent->complete_name : '' }}}</td>
				<td>{{ link_to_route('settings.labels.edit', 'Edit', array($label->id), array('class' => 'btn btn-info')) }}</td>
			</tr>
		@endforeach
		</tbody>
	</table>
@else
	There are no labels
@endif
@stop
