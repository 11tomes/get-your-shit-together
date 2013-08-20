@extends('layouts.scaffold')

@section('main')

<h1>All Priorities</h1>

<p>{{ link_to_route('settings.priorities.create', 'Add new priority') }}</p>

@if ($priorities->count())
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>Priority</th>
				<th>Level</th>
				<th>Order</th>
				<th>Color</th>
				<th>Description</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($priorities as $priority)
				<tr>
					<td>{{{ $priority->priority }}}</td>
					<td>{{{ $priority->level }}}</td>
					<td>{{{ $priority->order }}}</td>
					<td>{{{ $priority->color }}}</td>
					<td>{{{ $priority->description }}}</td>
                    <td>{{ link_to_route('settings.priorities.edit', 'Edit', array($priority->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('settings.priorities.destroy', $priority->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	There are no priorities
@endif

@stop
