@extends('admin.auth-master')

@section('meta:title', 'Change Password')

@section('content')

<div class="login-page frm-login-cntnr">
    <div class="login-box row no-gutters frm-login justify-content-center">
        <div class="align-self-center">
            <div class="card">
                <div class="frm-login__logo-hldr">
                    <img src="images/LOGO.png" class="img-fit mx-auto">
                </div>
                <h3 class="text-center font-weight-bold clr--light-gray mb-3">Reset Password</h3>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <form method="POST" action="{{ route('admin.password.change') }}">
                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">
                    <input type="hidden" name="email" value="{{ $email ?? old('email') }}">

                    @if ($errors->has('email'))
                        <p class="text-danger">{{ $errors->first('email') }}</p>
                    @endif

                    <div class="form-group has-feedback">
                        <div class="input-with-icon">
                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="New Password" required>

                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                            <i class="fa fa-eye-slash showPass"></i>
                        </div>
                    </div>

                    <div class="form-group has-feedback">
                        <div class="input-with-icon">
                            <input id="password" type="password" class="form-control" name="password_confirmation" placeholder="Confirm New Password" required>
                            <i class="fa fa-eye-slash showPass"></i>
                        </div>
                    </div>
                    
                    <div class="row">
                        <!-- /.col -->
                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-primary-action">
                                {{ __('Confirm Reset') }}
                            </button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
