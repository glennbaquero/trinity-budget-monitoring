<!DOCTYPE html>
<html class="no-js" lang="{{ app()->getLocale() }}">
<head>

    @include('partials.meta-tags')
    @include('admin.partials.styles')

</head>
<body class="sidebar-mini layout-fixed layout-navbar-fixed">
    
    <div id="app" class="wrapper">

        @include('manager.partials.header')
        @include('web.pages.manager.sidebar')

        
        @yield('content')

        {{-- @include('admin.partials.footer') --}}

        <dialog-container></dialog-container>

    </div>

    @include('partials.script-tags')

</body>
</html>