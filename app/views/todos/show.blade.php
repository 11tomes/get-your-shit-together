@extends('layouts.scaffold')

@section('main')

<h1>Show Todo</h1>

<p>{{ link_to_route('todos.index', 'Return to all todos') }}</p>

<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>Todo</th>
				<th>Notes</th>
				<th>Deadline</th>
				<th>Done_on</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>{{{ $todo->todo }}}</td>
					<td>{{{ $todo->notes }}}</td>
					<td>{{{ $todo->deadline }}}</td>
					<td>{{{ $todo->done_on }}}</td>
                    <td>{{ link_to_route('todos.edit', 'Edit', array($todo->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('todos.destroy', $todo->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
		</tr>
	</tbody>
</table>

@stop