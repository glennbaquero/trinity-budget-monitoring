<!DOCTYPE html>
<html class="no-js" lang="{{ app()->getLocale() }}">
<head>

    @include('partials.meta-tags')
    @include('admin.partials.styles')

</head>
<body class="login-page">
	
    <div id="app" class="login-box">
        <div class="login-logo">
            <a href="javascript:void(0)"><b>{{ config('app.name')}} Web</b></a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">

                @yield('content')

            </div>
        </div>
    </div>

    @include('partials.script-tags')

</body>
</html>