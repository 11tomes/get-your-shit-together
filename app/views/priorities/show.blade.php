@extends('layouts.scaffold')

@section('main')

<h1>Show Priority</h1>

<p>{{ link_to_route('priorities.index', 'Return to all priorities') }}</p>

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
		<tr>
			<td>{{{ $priority->priority }}}</td>
					<td>{{{ $priority->level }}}</td>
					<td>{{{ $priority->order }}}</td>
					<td>{{{ $priority->color }}}</td>
					<td>{{{ $priority->description }}}</td>
                    <td>{{ link_to_route('priorities.edit', 'Edit', array($priority->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('priorities.destroy', $priority->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
		</tr>
	</tbody>
</table>

@stop