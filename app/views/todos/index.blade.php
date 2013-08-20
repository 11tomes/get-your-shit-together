@extends('layouts.scaffold')

@section('main')

<h1>All Todos</h1>

<p>{{ link_to_route('todos.create', 'Add new todo') }}</p>

@if ($todos->count())
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>Todo</th>
				<th>Notes</th>
				<th>To Be Completed At</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($todos as $todo)
				<tr>
					<td>{{{ $todo->todo }}}</td>
					<td>{{{ $todo->notes }}}</td>
					<td>{{{ $todo->to_be_completed_at }}}</td>
                    <td>{{ link_to_route('todos.edit', 'Edit', array($todo->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('todos.destroy', $todo->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	There are no todos
@endif

@stop
