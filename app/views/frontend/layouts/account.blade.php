@extends('frontend/layouts/default')

{{-- Page content --}}
@section('content')
<div class="row">
	<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset=3 col-xs-12">
		@yield('account-content')
	</div>
</div>
@stop
