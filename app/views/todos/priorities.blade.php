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
<div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-4 col-lg-offset-4">
	<div class="panel drop-shadow lifted" style="padding: 0 !important; border-color: #{{{ $priority->color }}} !important;">
		<div class="panel-heading" style="background: #{{{ $priority->color }}} !important; border-color: #{{{ $priority->color }}} !important;">
			{{{ $priority->name }}}&bsnp;<span class="badge">{{{ count($priority->todos)  }}}</span>
		</div>
		<ul class="list-group">
		@foreach ($priority->todos as $todo)
			<li class="list-group-item">
				<i class="icon-check{{ $todo->isDone() ? '' : '-empty' }}"></i>
				<span class="handwritten"{{ $todo->isDone() ? ' style="text-decoration: line-through;"' : '' }}>
					{{{ $todo->todo }}}
				</span>
			</li>
		@endforeach
			<li class="list-group-item">
				@include('todos/add')
			</li>
		</ul>
	</div>
</div>
@endforeach
@stop
