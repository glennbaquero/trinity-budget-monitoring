<aside class="main-sidebar sidebar-dark-danger">
    <a href="{{ route('web.ppp-available.ppp-budget') }}" class="brand-link bg--light-green">
        @include('partials.brand')
    </a>

    <div class="sidebar">
        @if (auth()->check())
            <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
                <div class="image">
                    <img src="{{ $self->renderAvatar() }}" class="img-circle elevation-2" style="width: 40px; height: 40px; border: 1px solid #fff;">
                </div>
                <div class="info">
                    <a href="{{ route('web.profiles.show') }}" class="d-block font-weight-bold clr--white">
                        {{ $self->renderName() }}
                    </a>
                    <h5 class="clr--white mb-0">Sales Representative</h5>
                </div>
            </div>
        @endif

        <div class="frm-sidebar__main-nav">
            <p>MAIN NAVIGATION</p>
        </div>
        
        <nav class="mt-2">
            <ul class="nav nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('web.profiles.show') }}" class="nav-link {{ $checker->route->areOnRoutes([
                        'web.profiles.show',
                    ]) }}">
                        <i class="nav-icon fa fa-user"></i>
                        <p>
                            User Account
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('web.ppp-available.ppp-budget') }}" class="nav-link {{ $checker->route->areOnRoutes([
                        'web.ppp-available.ppp-budget',
                    ]) }}">
                        <i class="nav-icon fa fa-dna"></i>
                        <p>
                            PPP Available Budget
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('web.po-request.index') }}" class="nav-link {{ $checker->route->areOnRoutes([
                        'web.po-request.index', 'web.po-request.show', 'web.po-request.create',
                    ]) }}">
                        <i class="nav-icon fa fa-dna"></i>
                        <p>
                            Purchase Order Request
                        </p>
                    </a>
                </li>

            </ul>
        </nav>

    </div>
</aside>