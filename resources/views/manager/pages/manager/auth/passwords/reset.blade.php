@extends('web.master')

@section('meta:title', 'Change Password')

@section('content')


<div class="frm-login-cntnr">
    <div class="row no-gutters frm-login mx-auto justify-content-center">
        <div class="align-self-center">
            <div class="card mx-auto">
                    <div class="frm-login__logo-hldr">
                        <img src="images/LOGO.png" class="img-fit mx-auto">
                    </div>
                    <form method="POST" action="{{ route('manager.password.change') }}">
                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">
                    <input type="hidden" name="email" value="{{ $email ?? old('email') }}">

                    @if ($errors->has('email'))
                        <p class="text-danger">{{ $errors->first('email') }}</p>
                    @endif
                    
                    <h3 class="text-center font-weight-bold clr--light-gray mb-3">Reset Password</h3>
                    <div class="form-row">
                        <div class="form-group col-12">
                            <div class="input-with-icon">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="New Password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                                <i class="fa fa-eye-slash showPass" aria-hidden="true"></i>
                            </div>
                        </div>
                        <div class="form-group col-12">
                            <div class="input-with-icon">
                                <input id="password" type="password" class="form-control" name="password_confirmation" placeholder="Confirm New Password" required>
                                <i class="fa fa-eye-slash showPass" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                    <div class="form-row align-items-center">
                        <div class="form-group col-md-12 text-center">
                            <button type="submit" class="frm-btn">{{ __('Reset Password') }}</button>
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