<aside class="main-sidebar sidebar-dark-danger">
    <a href="{{ route('admin.dashboard') }}" class="brand-link bg--light-green">
        @include('partials.brand')
    </a>

    <div class="sidebar">
        @if (auth()->check())
            <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
                <div class="image">
                    <img src="{{ $self->renderAvatar() }}" class="img-circle elevation-2" style="width: 40px; height: 40px; border: 1px solid #fff;">
                </div>
                <div class="info">
                    <a href="{{ route('admin.profiles.show') }}" class="d-block font-weight-bold clr--white">
                        {{ $self->renderName() }}
                    </a>
                    <h5 class="clr--white mb-0">Admin</h5>
                </div>
            </div>
        @endif

        <div class="frm-sidebar__main-nav">
            <p>MAIN NAVIGATION</p>
        </div>
        
        <nav class="mt-2">
            <ul class="nav nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ $checker->route->areOnRoutes([
                        'admin.dashboard',
                    ]) }}">
                        <i class="nav-icon fa fa-th"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                
{{--                 @if ($self->hasAnyPermission(['admin.pages.crud', 'admin.page-items.crud', 'admin.articles.crud']))
                    <li class="nav-item has-treeview {{ $checker->route->areOnRoutes([
                            'admin.pages.index','admin.pages.create','admin.pages.show',
                            'admin.page-items.index','admin.page-items.create','admin.page-items.show',
                            'admin.articles.index','admin.articles.create','admin.articles.show',
                        ]) }}">
                        <a href="javascript:void(0)" class="nav-link">
                            <i class="nav-icon fas fa-feather"></i>
                            <p>
                                Content Management
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if ($self->hasAnyPermission(['admin.pages.crud']))
                                <li class="nav-item">
                                    <a href="{{ route('admin.pages.index') }}" class="nav-link {{ $checker->route->areOnRoutes([
                                        'admin.pages.index','admin.pages.create','admin.pages.show',
                                    ]) }}">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>
                                            Pages
                                        </p>
                                    </a>
                                </li>
                            @endif
                            
                            @if ($self->hasAnyPermission(['admin.page-items.crud']))
                                <li class="nav-item">
                                    <a href="{{ route('admin.page-items.index') }}" class="nav-link {{ $checker->route->areOnRoutes([
                                        'admin.page-items.index','admin.page-items.create','admin.page-items.show',
                                    ]) }}">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>
                                            Page Items
                                        </p>
                                    </a>
                                </li>
                            @endif

                            @if ($self->hasAnyPermission(['admin.articles.crud']))
                                <li class="nav-item">
                                    <a href="{{ route('admin.articles.index') }}" class="nav-link {{ $checker->route->areOnRoutes([
                                        'admin.articles.index','admin.articles.create','admin.articles.show',
                                    ]) }}">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>
                                            Articles
                                        </p>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif --}}

                @if ($self->hasAnyPermission(['admin.budgets.crud']))
                <li class="nav-item">
                    <a href="{{ route('admin.budgets.index') }}" class="nav-link {{ $checker->route->areOnRoutes([
                        'admin.budgets.index','admin.budgets.create','admin.budgets.show'
                    ]) }}">
                        <i class="nav-icon fas fa-square"></i>
                        <p>
                            Main Budget
                        </p>
                    </a>
                </li>
                @endif
                
                <li class="nav-item">
                    <a href="{{ route('admin.po-requests.index') }}" class="nav-link {{ $checker->route->areOnRoutes([
                        'admin.po-requests.index','admin.po-requests.show'
                    ]) }}">
                        <i class="nav-icon fas fa-dna"></i>
                        <p>
                            Purchase Order Request
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.ppp-requests.index') }}" class="nav-link {{ $checker->route->areOnRoutes([
                        'admin.ppp-requests.index','admin.ppp-requests.show'
                    ]) }}">
                        <i class="nav-icon fas fa-dna"></i>
                        <p>
                            PPP Request
                        </p>
                    </a>
                </li>

                {{-- @if ($self->hasAnyPermission(['admin.positions.crud']))
                <li class="nav-item">
                    <a href="{{ route('admin.positions.index') }}" class="nav-link {{ $checker->route->areOnRoutes([
                        'admin.positions.index','admin.positions.create','admin.positions.show'
                    ]) }}">
                        <i class="nav-icon fas fa-user-plus"></i>
                        <p>
                            Positions
                        </p>
                    </a>
                </li>
                @endif --}}
                
                @if ($self->hasAnyPermission(['admin.specializations.crud']))
                <li class="nav-item">
                    <a href="{{ route('admin.specializations.index') }}" class="nav-link {{ $checker->route->areOnRoutes([
                        'admin.specializations.index','admin.specializations.create','admin.specializations.show'
                    ]) }}">
                        <i class="nav-icon fas fa-dna"></i>
                        <p>
                            Specializations
                        </p>
                    </a>
                </li>
                @endif

                @if ($self->hasAnyPermission(['admin.products.crud']))
                <li class="nav-item">
                    <a href="{{ route('admin.products.index') }}" class="nav-link {{ $checker->route->areOnRoutes([
                        'admin.products.index','admin.products.create','admin.products.show'
                    ]) }}">
                        <i class="nav-icon fas fa-capsules"></i>
                        <p>
                            Products
                        </p>
                    </a>
                </li>
                @endif



                @if ($self->hasAnyPermission(['admin.admin-users.crud', 'admin.roles.crud', 'admin.users.crud', 'admin.activity-logs.crud']))
                    <li class="nav-header">Admin Management</li>
                @endif

                @if ($self->hasAnyPermission(['admin.admin-users.crud', 'admin.roles.crud']))
                    <li class="nav-item has-treeview {{ $checker->route->areOnRoutes([
                            'admin.admin-users.index','admin.admin-users.create','admin.admin-users.show',
                            'admin.roles.index', 'admin.roles.create', 'admin.roles.show',
                        ]) }}">
                        <a href="javascript:void(0)" class="nav-link">
                            <i class="nav-icon fas fa-user-shield"></i>
                            <p>
                                Admin Management
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if ($self->hasAnyPermission(['admin.admin-users.crud']))
                                <li class="nav-item">
                                    <a href="{{ route('admin.admin-users.index') }}" class="nav-link {{ $checker->route->areOnRoutes([
                                        'admin.admin-users.index','admin.admin-users.create','admin.admin-users.show',
                                    ]) }}">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>
                                            Admins
                                        </p>
                                    </a>
                                </li>
                            @endif

                            @if ($self->hasAnyPermission(['admin.roles.crud']))
                                <li class="nav-item">
                                    <a href="{{ route('admin.roles.index') }}" class="nav-link {{ $checker->route->areOnRoutes([
                                        'admin.roles.index', 'admin.roles.create', 'admin.roles.show'
                                    ]) }}">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>
                                            Roles & Permissions
                                        </p>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

                @if ($self->hasAnyPermission(['admin.users.crud']))
                    <li class="nav-item has-treeview {{ $checker->route->areOnRoutes([
                            'admin.users.index','admin.users.create','admin.users.show',
                        ]) }}">
                        <a href="javascript:void(0)" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                User Management
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if ($self->hasAnyPermission(['admin.users.crud']))
                                <li class="nav-item">
                                    <a href="{{ route('admin.users.index') }}" class="nav-link {{ $checker->route->areOnRoutes([
                                        'admin.users.index','admin.users.create','admin.users.show',
                                    ]) }}">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>
                                            Users
                                        </p>
                                    </a>
                                </li>
                            @endif
                                <li class="nav-item">
                                    <a href="{{ route('admin.managers.index') }}" class="nav-link {{ $checker->route->areOnRoutes([
                                        'admin.managers.index','admin.managers.create','admin.managers.show',
                                    ]) }}">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>
                                            Manager
                                        </p>
                                    </a>
                                </li>
                        </ul>
                    </li>
                @endif

                @if ($self->hasAnyPermission(['admin.activity-logs.crud']))
                    <li class="nav-item">
                        <a href="{{ route('admin.activity-logs.index') }}" class="nav-link {{ $checker->route->areOnRoutes([
                            'admin.activity-logs.index',
                        ]) }}">
                            <i class="nav-icon fa fa-file-alt"></i>
                            <p>
                                Activity Logs
                            </p>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>

    </div>
</aside>