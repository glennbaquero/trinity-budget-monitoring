<!DOCTYPE html>
<html class="no-js" lang="{{ app()->getLocale() }}">
<head>

    @include('partials.meta-tags')
    @include('admin.partials.styles')

</head>
<body class="">

	{{-- <div id="app" class="login-box">
	    <div class="login-logo">
	        <a class="font-weight-bold" href="javascript:void(0)"><b>{{ config('app.name')}} Admin</b></a>
	    </div>
	    <!-- /.login-logo -->
	    <div class="card">
		    <div class="card-body login-card-body">

		        @yield('content')

		    </div>
	    </div>
    </div> --}}
    
    <div id="app">

        @yield('content')
        
    </div>

    @include('partials.script-tags')

</body>
</html>