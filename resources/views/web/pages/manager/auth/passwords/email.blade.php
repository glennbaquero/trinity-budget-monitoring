@extends('web.auth-master')

@section('meta:title', 'Forgot Password')

@section('content')

<div class="frm-login-cntnr">
    <div class="row no-gutters frm-login mx-auto justify-content-center">
        <div class="align-self-center">
            <div class="card mx-auto">            
                <div class="frm-login__logo-hldr">
                    <img src="images/LOGO.png" class="img-fit mx-auto">
                </div>
                <form method="POST" action="{{ route('manager.password.email') }}">
                    @csrf
                    <h3 class="text-center font-weight-bold clr--light-gray mb-3">Enter recovery email</h3>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif                
                    <div class="form-row">
                        <div class="form-group col-12">
                            <div class="input-with-icon">
                                 <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Enter your Email Address" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                    <div class="form-row align-items-center">
                        <div class="form-group col-md-12 text-center">
                            <a href="web/forget-password#success"><div class="form-group align-c">                            
                            <button type="submit" class="frm-btn">{{ __('Send Password Reset Link') }}</button>            
                        </div></a>
                        <div class="form-group col-md-12 text-center">
                            <a href="manager/login" class="link font--14 clr--black">Back to Login</a>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection