@extends('layouts.scaffold')

@section('main')

<h1>Show Label</h1>

<p>{{ link_to_route('labels.index', 'Return to all labels') }}</p>

<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>Label</th>
				<th>Color</th>
				<th>Description</th>
				<th>Parent_id</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>{{{ $label->label }}}</td>
					<td>{{{ $label->color }}}</td>
					<td>{{{ $label->description }}}</td>
					<td>{{{ $label->parent_id }}}</td>
                    <td>{{ link_to_route('labels.edit', 'Edit', array($label->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('labels.destroy', $label->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
		</tr>
	</tbody>
</table>

@stop