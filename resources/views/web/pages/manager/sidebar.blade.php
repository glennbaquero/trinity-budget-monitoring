<aside class="main-sidebar sidebar-dark-danger">
    <a href="{{ route('manager.dashboard') }}" class="brand-link bg--light-green">
        @include('partials.brand')
    </a>

    <div class="sidebar">
        @if (auth()->check())
            <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
                <div class="image">
                    <img src="{{ $self->renderAvatar() }}" class="img-circle elevation-2" style="width: 40px; height: 40px; border: 1px solid #fff;">
                </div>
                <div class="info">
                    <a href="{{ route('manager.profiles.show') }}" class="d-block font-weight-bold clr--white">
                        {{ auth()->guard('manager')->user()->renderName() }}
                    </a>
                    <h5 class="clr--white mb-0">{{ auth()->guard('manager')->user()->getPosition() }}</h5>
                </div>
            </div>
        @endif

        <div class="frm-sidebar__main-nav">
            <p>MAIN NAVIGATION</p>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-item">
                    <a href="{{ route('manager.profiles.show') }}" class="nav-link {{ $checker->route->areOnRoutes([
                        'manager.profiles.show',
                    ]) }}">
                        <i class="nav-icon fa fa-user"></i>
                        <p>
                            User Account
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('manager.dashboard') }}" class="nav-link {{ $checker->route->areOnRoutes([
                        'manager.dashboard',
                    ]) }}">
                        <i class="nav-icon fa fa-square"></i>
                        <p>
                            Main Budget
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('manager.ppp-request.index') }}" class="nav-link {{ $checker->route->areOnRoutes([
                        'manager.ppp-request.index', 'manager.ppp-request.show', 'manager.ppp-request.create',
                    ]) }}">
                        <i class="nav-icon fa fa-dna"></i>
                        <p>
                            PPP Budget
                        </p>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a href="{{ route('manager.po-request.index') }}" class="nav-link {{ $checker->route->areOnRoutes([
                        'manager.po-request.index', 'manager.po-request.show',
                    ]) }}">
                        <i class="nav-icon fa fa-dna"></i>
                        <p>
                            PO Request Management
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('manager.po.export.index') }}" class="nav-link {{ $checker->route->areOnRoutes([
                        'manager.po.export.index',
                    ]) }}">
                        <i class="nav-icon fa fa-file-download"></i>
                        <p>
                            Export Management Reports
                        </p>
                    </a>
                </li>
            </ul>
        </nav>

    </div>
</aside>