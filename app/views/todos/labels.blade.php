@extends('layouts.scaffold')

@section('main')

<h1>Todos by Labels</h1>

@foreach ($labels as $label)
<div class="col-md-6 col-xs-12 col-sm-10 col-sm-offset-1 col-lg-4">
	<div class="panel" style="border-color: #{{{ $label->color }}} !important;">
		<div class="panel-heading" style="background: #{{{ $label->color }}} !important; border-color: #{{{ $label->color }}} !important;">
			{{{ $label->label }}}
		</div>
		<ul class="list-group">
		@foreach ($label->todos as $todo)
			<li class="list-group-item">
				<span class="handwritten"<?php echo $todo->isDone() ? ' style="text-decoration: line-through;"' : '' ?>>
					{{{ $todo->todo }}}
				</span>
			</li>
		@endforeach
		</ul>
	</div>
</div>
@endforeach

@stop
