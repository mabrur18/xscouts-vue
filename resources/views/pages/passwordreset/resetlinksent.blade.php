@extends('layouts.app')
@section('content')
<div class="container mt-4">
	<h3>Password Reset </h3>
	<hr />
	<div class="">
		<h4 class="text-info bold">
			<i class="material-icons">email</i> A message has been sent to your email. Kindly follow the link to reset your password
		</h4>
	</div>
	<hr />
	<a href="<?php print_link("/"); ?>" class="btn btn-info">Click here to login</a>
</div>
@endsection