
	<div class="container">
	<h4>Change Password</h4>
	<hr />
	<div class="row">
		<div class="col-md-7">
			<form name="loginForm" action="<?php print_link("account/changepassword") ?>" method="post">
				@csrf
				<div class="form-group">
					<input placeholder="Current Password" name="oldpassword" required="required" class="form-control" type="password" />
				</div>

				<div class="form-group">
					<div id="ctrl-password-holder" class="input-group ">
						<input value="" type="password" id="ctrl-newpassword" placeholder="New Password" required="" name="newpassword" class="form-control  password password-strength" />
						<div class="input-group-append cursor-pointer btn-toggle-password">
							<span class="input-group-text"><i class="material-icons">visibility</i></span>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div id="ctrl-confirmpassword-holder" class="input-group ">
						<input id="ctrl-password-confirm" data-match="#ctrl-newpassword" class="form-control password-confirm " type="password" name="confirmpassword" required placeholder="Confirm new password" />
						<div class="input-group-append cursor-pointer btn-toggle-password">
							<span class="input-group-text"><i class="material-icons">visibility</i></span>
						</div>
					</div>
				</div>

				<div class="text-center">
					<button class="btn btn-primary" type="submit">Change Password</button>
				</div>
			</form>
		</div>
	</div>
</div>
