@extends('layouts.scaffold')

@section('title')
Priorities
@stop

@section('main')
<p>{{ link_to_route('settings.priorities.create', 'Add new priority') }}</p>
@if ($priorities->count())
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th></th>
				<th>Name</th>
				<th>Preview</th>
				<th>Description</th>
				<th></th>
			</tr>
		</thead>

		<tbody>
		@foreach ($priorities as $priority)
			<tr>
				<td style="width: auto !important">
					{{ Form::open(array('method' => 'DELETE', 'route' => array('settings.priorities.destroy', $priority->id))) }}
					{{ Form::button('<i class="icon-trash"></i>', array('type' => 'submit', 'class' => 'btn btn-danger')) }}
					{{ Form::close() }}
				</td>
				<td>{{{ $priority->name }}}</td>
				<td>
					<i class="icon-asterisk" style="color: #{{ $priority->color }}"></i>
				</td>
				<td>{{{ $priority->description }}}</td>
				<td>{{ link_to_route('settings.priorities.edit', 'Edit', array($priority->id), array('class' => 'btn btn-info')) }}</td>
		</tr>
		@endforeach
		</tbody>
	</table>
@else
	There are no priorities
@endif
@stop
