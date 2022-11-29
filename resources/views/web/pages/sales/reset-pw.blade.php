@extends('web.auth-master')

@section('content')


<div class="frm-login-cntnr">
	<div class="row no-gutters frm-login mx-auto justify-content-center">
		<div class="align-self-center">
			<div class="card mx-auto">
				<div class="frm-login__logo-hldr">
					<img src="images/LOGO.png" class="img-fit mx-auto">
				</div>
				<form>
					<h3 class="text-center font-weight-bold clr--light-gray mb-3">Reset Password</h3>
					<div class="form-row">
						<div class="form-group col-12">
					      	<div class="input-with-icon">
						      	<input class="form-control" type="password" placeholder="New Password">
					        	<i class="fa fa-eye-slash showPass" aria-hidden="true"></i>
						    </div>
					    </div>
					    <div class="form-group col-12">
					      	<div class="input-with-icon">
						      	<input class="form-control" type="password" placeholder="Confirm Password">
					        	<i class="fa fa-eye-slash showPass" aria-hidden="true"></i>
						    </div>
					    </div>
					</div>
					<div class="form-row align-items-center">
						<div class="form-group col-md-12 text-center">
					      	<button class="frm-btn">Send reset link</button>
					    </div>
					    <div class="form-group col-md-12 text-center">
					      	<a href="sales/login" class="link font--14 clr--black">Back to Login</a>
					    </div>
					</div>

				</form>
			</div>
		</div>
	</div>
</div>

@endsection