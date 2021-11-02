@extends('layouts.app')
@section('content')
<div class="container mt-4">
	<h4>Email verification completed.</h4>
	<hr />
	<div class="">
		<a href="{{ route('home') }}" class="btn btn-primary">Continue</a>
	</div>
</div>
@endsection