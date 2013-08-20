@extends('layouts.scaffold')

@section('main')

<h1>All Labels</h1>

<p>{{ link_to_route('labels.create', 'Add new label') }}</p>

@if ($labels->count())
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
			@foreach ($labels as $label)
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
			@endforeach
		</tbody>
	</table>
@else
	There are no labels
@endif

@stop