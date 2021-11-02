@extends('layouts.app')
@section('content')
<div class="container mt-4">
	<div>
		<h3>Password Reset </h3>
		<small class="text-muted">
			Please provide the valid email address you used to register
		</small>
	</div>
	<hr />
	<div class="row">
		<div class="col-md-8">
			@if (session('status'))
			<div class="alert alert-success">
				{{ session('status') }}
			</div>
			@endif
			<form class="form-horizontal" role="form" method="POST" action="{{ route('password.email') }}">
				@csrf
				<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
					@if ($errors->has('email'))
					<span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>
					@endif
					<input type="text" class="form-control" id="email" name="email" placeholder="Email" />
				</div>
				<div>
					<button class="btn btn-success" type="submit"> Send <i class="material-icons">email</i></button>
				</div>
			</form>
		</div>
	</div>
	<br />
	<div class="text-info">
		A link will be sent to your email containing the information you need for your password
	</div>
</div>
@endsection