{{-- @extends('web.master') --}}
@extends('web.auth-master')

@section('content')


<div class="frm-login-cntnr">
    <div class="row no-gutters frm-login">
        <div class="frm-bckgrnds size--cover" style="background-image: url('images/sales-login-bg.svg');"></div>
        <div class="align-self-center">
            <div class="card">
                <div class="frm-login__logo-hldr">
                    <img src="images/LOGO.png" class="img-fit mx-auto">
                </div>
                <form action="{{ route('web.login') }}" method="POST">
                    <h3 class="text-center font-weight-bold clr--light-gray mb-3">Sign in to start your session</h3>
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-12">
                                <div class="input-with-icon show_hide_password">
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Email" required autofocus>
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                    @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group col-12">
                                <div class="input-with-icon show_hide_password">
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" required>
                                    <i class="fa fa-eye-slash showPass" aria-hidden="true"></i>
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif  
                                </div>
                            </div>
                        </div>
                        <div class="form-row align-items-center">
                            <div class="form-group col-md-6">
                                <a href="{{ route('web.password.request') }}" class="link forgot-pw">Forgot password</a>
                            </div>
                            <div class="form-group col-md-6 text-right">
                                <button type="submit" class="frm-btn">Login</button>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>

    <div class="frm-svg frm-svg__sales">
        
        <sales-svg></sales-svg>
        {{-- <img class="img-fit frm-svg" src="images/sales-login-svg.svg"> --}}
        
    </div>
</div>

@endsection