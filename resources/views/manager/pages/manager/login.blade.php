@extends('web.master')

@section('content')


<div class="frm-login-cntnr">
	<div class="row no-gutters frm-login">
		<div class="frm-bckgrnds size--cover" style="background-image: url('images/mngr-login-bg.svg');"></div>
		<div class="align-self-center">
			<div class="card">
				<div class="frm-login__logo-hldr">
					<img src="images/LOGO.png" class="img-fit mx-auto">
				</div>
				<form>
					<h3 class="text-center font-weight-bold clr--light-gray mb-3">Sign in to start your session</h3>
					<div class="form-row">
						<div class="form-group col-12">
					      	<div class="input-with-icon">
						      	<input class="form-control" type="email" placeholder="Email">
					        	<i class="fa fa-user"></i>
						    </div>
					    </div>
						<div class="form-group col-12">
					      	<div class="input-with-icon">
						      	<input class="form-control" type="password" placeholder="Password">
					        	<i class="fa fa-eye-slash showPass"></i>
						    </div>
					    </div>
					</div>
					<div class="form-row align-items-center">
						<div class="form-group col-md-6">
					      	<a href="" class="link forgot-pw">Forgot password</a>
					    </div>
						<div class="form-group col-md-6 text-right">
					      	<button class="frm-btn">Login</button>
					    </div>
					</div>

				</form>
			</div>
		</div>
	</div>
	<div class="frm-svg frm-svg__manager">
		
		<manager-svg></manager-svg>
		{{-- <img class="img-fit frm-svg" src="images/mngr-login-svg.svg"> --}}
		
	</div>
</div>

@endsection