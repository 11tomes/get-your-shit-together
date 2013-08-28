@extends('layouts.scaffold')

@section('styles')
	@parent
	<link href="{{ asset('assets/css/shadows.css') }}" rel="stylesheet">
@stop

@section('title')
	View: Priorities
@stop

@section('main')
@foreach ($priorities as $priority)
<div class="col-md-8 col-md-offset-2">
	<div class="panel drop-shadow lifted" style="padding: 0 !important; border-color: #{{{ $priority->color }}} !important;">
		<div class="panel-heading" style="background: #{{{ $priority->color }}} !important; border-color: #{{{ $priority->color }}} !important;">
			{{{ $priority->name }}}&nbsp;<span class="badge">{{{ count($priority->todos)  }}}</span>
		</div>
		<ul class="list-group">
		@foreach ($priority->todos as $todo)
			@include('todos/todo')
		@endforeach
			<li class="list-group-item">
				<?php $extra_html = Form::hidden('priority_id', $priority->id); ?>
				@include('todos/add')
			</li>
		</ul>
	</div>
</div>
@endforeach
@stop
