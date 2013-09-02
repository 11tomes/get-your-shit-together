@extends('layouts.scaffold')

@section('styles')
	@parent
	<link href="{{ asset('assets/css/shadows.css') }}" rel="stylesheet">
@stop

@section('title')
	View: Labels
@stop

@section('main')
<?php 
	$rows = 2;
	$count = count($labels);
	$grouped_labels = array();
	for ($i = 0; $i < $rows; $i++) {
		$grouped_labels[] = $labels->slice($i * $count/$rows, $count/$rows, TRUE);
	}
?>
@foreach ($grouped_labels as $labels)
<div class="col-md-6">
@foreach ($labels as $label)
	<div class="panel drop-shadow lifted" style="padding: 0 !important; border-color: #{{{ $label->color }}} !important;">
		<div class="panel-heading" style="background: #{{{ $label->color }}} !important; border-color: #{{{ $label->color }}} !important;">
			{{{ $label->name }}}&nbsp;<span class="badge">{{{ count($label->todos)  }}}</span>
		</div>
		<ul class="list-group">
		@foreach ($label->todos as $todo)
			@include('todos/todo')
		@endforeach
			<li class="list-group-item">
				@include('todos/add', compact('extra_html'))
			</li>
		</ul>
	</div>
@endforeach
</div>
@endforeach
@stop
