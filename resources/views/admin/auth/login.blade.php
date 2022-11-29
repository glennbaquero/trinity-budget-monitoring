@extends('admin.auth-master')

@section('meta:title', 'Login')

@section('content')

<div class="frm-login-cntnr">
    <div class="row no-gutters frm-login">
        <div class="frm-bckgrnds size--cover" style="background-image: url('images/admin-login-bg.svg');"></div>
        <div class="align-self-center">
            <div class="card">
                <div class="frm-login__logo-hldr">
                    <img src="images/LOGO.png" class="img-fit mx-auto">
                </div>
                <h3 class="text-center font-weight-bold clr--light-gray mb-3">Sign in to start your session</h3>
                <form action="{{route('admin.login')}}" method="POST">
                    @csrf
                    <div class="form-group has-feedback">
                        <div class="input-with-icon">
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Email" required autofocus>

                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                            <i class="fa fa-user"></i>
                        </div>
                    </div>
                    <div class="form-group has-feedback">
                        <div class="input-with-icon">                            
                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" required>

                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                            <i class="fa fa-eye-slash showPass"></i>
                        </div>
                    </div>
                    <div class="form-row align-items-center">
                        <div class="form-group col-md-6">
                            <a class="link forgot-pw" href="{{ route('admin.password.request') }}">Forgot Password</a>
                        </div>
                        <div class="form-group col-md-6 text-right">
                            <button type="submit" class="frm-btn">Login</button>
                        </div>
                    </div>
                </form>
                {{-- <form>
                    <h3 class="text-center font-weight-bold clr--light-gray mb-3">Sign in to start your session</h3>
                    <div class="form-row">
                        <div class="form-group col-12">
                            <div class="input-with-icon">
                                <input class="form-control" type="email" placeholder="Email">
                                <i class="fa fa-user" aria-hidden="true"></i>
                            </div>
                        </div>
                        <div class="form-group col-12">
                            <div class="input-with-icon">
                                <input class="form-control" type="password" placeholder="Password">
                                <i class="fa fa-eye-slash showPass" aria-hidden="true"></i>
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

                </form> --}}
            </div>
        </div>
    </div>
    <div class="frm-svg frm-svg__admin">
        
        <admin-svg></admin-svg>
        {{-- <img class="img-fit frm-svg" src="images/admin-login-svg.svg"> --}}
        
    </div>
</div>

@endsection