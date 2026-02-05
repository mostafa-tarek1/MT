<!DOCTYPE html>
<html lang="{{app()->getLocale()}}">
    @include('base::components.dashboard.layouts.head')

    <body class="vertical-layout vertical-menu-modern 2-columns  navbar-floating footer-static   menu-collapsed" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">

    @include('base::components.dashboard.layouts.navbar')

    @include('base::components.dashboard.layouts.sidebar')

    <div class="app-content content">
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row"></div>
            <div class="content-body">
                @yield('content')
            </div>
        </div>
    </div>

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    @include('base::components.dashboard.layouts.footer')

    </body>
</html>

