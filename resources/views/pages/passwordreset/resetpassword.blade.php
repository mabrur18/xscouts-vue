@extends('layouts.app')
@section('content')
<div class="container mt-4">
	<h3>Password Reset </h3>
	<hr />
	<div class="row">
		<div class="col-sm-6">
			<section class="login_content">
				@if (session('status'))
				<div class="alert alert-success">
					{{ session('status') }}
				</div>
				@endif
				<form role="form" method="POST" action="{{ route('password.resetpassword') }}">
					<h3>Reset Password</h3>
					@csrf
					<input type="hidden" name="token" value="{{ request()->token }}">
					<input type="hidden" name="email" value="{{ request()->email }}">
					@if ($errors->any())
					<div class="alert alert-danger">
						<ul>
							@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>
					@endif
					<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
						<input type="text" class="form-control" id="email" name="email" placeholder="Email" />
					</div>
					<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
						<label>New Password</label>
						<input type="password" class="form-control" id="password" name="password" placeholder="Password" />
					</div>
					<div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
						<label>Confirm new password</label>
						<input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm Password" />
					</div>
					<div class="mt-2">
						<button class="btn btn-success" type="submit">Change Password</button>
					</div>
				</form>
			</section>
		</div>
	</div>
</div>
@endsection