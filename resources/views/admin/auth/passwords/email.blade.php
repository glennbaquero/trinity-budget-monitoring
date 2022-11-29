@extends('admin.auth-master')

@section('meta:title', 'Forgot Password')

@section('content')

<div class="login-page frm-login-cntnr">
    <div class="login-box row no-gutters frm-login justify-content-center">
        <div class="align-self-center">
            <div class="card">
                <div class="frm-login__logo-hldr">
                    <img src="images/LOGO.png" class="img-fit mx-auto">
                </div>
                <h3 class="text-center font-weight-bold clr--light-gray mb-3">Enter recovery email</h3>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <form method="POST" action="{{ route('admin.password.email') }}">
                    @csrf

                   <div class="form-group has-feedback">
                        <div class="input-with-icon">
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Enter your Email Address" required autofocus>
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                        </div>
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="row">
                        <!-- /.col -->
                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-primary-action">
                                {{ __('Send Reset Link') }}
                            </button>
                        </div>
                        <div class="col-md-12 text-center mt-3">
                            <a class="link clr--black" href="{{ route('admin.login') }}">Back to Login</a>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
