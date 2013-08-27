@extends('layouts.scaffold')

@section('styles')
	@parent
	<link href="{{ asset('assets/css/shadows.css') }}" rel="stylesheet">
@stop

@section('page_header')
	Todos By Labels
@stop

@section('main')
@foreach ($labels as $label)
<div class="col-md-6 col-xs-12 col-sm-10 col-sm-offset-1 col-lg-4">
	<div class="panel drop-shadow lifted" style="padding: 0 !important; border-color: #{{{ $label->color }}} !important;">
		<div class="panel-heading" style="background: #{{{ $label->color }}} !important; border-color: #{{{ $label->color }}} !important;">
			{{{ $label->name }}} <span class="badge">{{{ count($label->todos)  }}}</span>
		</div>
		<ul class="list-group">
		@foreach ($label->todos as $todo)
			<li class="list-group-item">
				<i class="icon-check{{ $todo->isDone() ? '' : '-empty' }}"></i>
				<span class="handwritten"{{ $todo->isDone() ? ' style="text-decoration: line-through;"' : '' }}>
					{{{ $todo->todo }}}
				</span>
			</li>
		@endforeach
		</ul>
	</div>
</div>
@endforeach
@stop
