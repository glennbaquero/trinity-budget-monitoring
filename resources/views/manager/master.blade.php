<!DOCTYPE html>
<html class="no-js" lang="{{ app()->getLocale() }}">
<head>

    @include('partials.meta-tags')
    @include('manager.partials.meta-tags')
    @include('manager.partials.styles')

</head>
<body>

    <div id="app">

        @include('manager.partials.header')
        
        @yield('content')

        @include('manager.partials.footer')

        {{-- Dialogs --}}
        <dialog-container></dialog-container>

    </div>

    @include('partials.script-tags')

</body>
</html>