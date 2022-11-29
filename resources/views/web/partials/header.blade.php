{{-- <div class="position-fixed fixed-top">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="{{ route('web.home') }}">
            <img src="/images/logo.png" class="rounded" style="width: 20px;">
            {{ config('app.name') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        
            <ul class="navbar-nav ml-auto">
                <li class="nav-item {{ $checker->route->areOnRoutes(['web.about']) }}">
                    <a class="nav-link" href="{{ route('web.about') }}">About</a>
                </li>
                <li class="nav-item {{ $checker->route->areOnRoutes(['web.articles.index']) }}">
                    <a href="{{ route('web.articles.index') }}" class="nav-link">Articles</a>
                </li>

                <li class="nav-item border-right mx-2"></li>

                @if(auth('web')->check())
                    <li class="nav-item btn-group">
                        <a class="nav-link" href="{{ route('web.dashboard') }}" tabindex="-1" aria-disabled="true">User Dashboard</a>
                        <a href="javascript:void(0)" class="nav-link dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="sr-only">Toggle Dropdown</span>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ route('web.logout') }}">Logout</a>
                        </div>
                        </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('web.login') }}" tabindex="-1" aria-disabled="true">User Login</a>
                    </li>
                @endif

                <li class="nav-item border-right mx-2"></li>

                @if(auth('admin')->check())
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.dashboard') }}" tabindex="-1" aria-disabled="true">Admin Dashboard</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.login') }}" tabindex="-1" aria-disabled="true">Admin Login</a>
                    </li>
                @endif
            </ul>
        </div>
    </nav>
    <div class="card">
       
    </div>
</div>

<div style="height: 49px;"></div>
 --}}
@if(Auth::check())
<nav class="main-header navbar navbar-expand border-bottom navbar-dark bg--dark-green">
    <ul class="navbar-nav">
        <li class="nav-item">
            {{-- <a class="nav-link text-white" data-widget="pushmenu" href="javascript:void(0)"><i class="fas fa-bars"></i></a> --}}
        </li>
    </ul>


    <ul class="navbar-nav ml-auto">
        <li class="nav-item d-none d-sm-inline-block">
            <a class="nav-link text-white frm-main__header" href="{{ route('web.logout') }}">Logout</a>
        </li>

    </ul>
</nav>
@endif
