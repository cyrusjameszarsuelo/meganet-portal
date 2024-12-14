<!DOCTYPE html>
<html>

<head>
    @include('includes.head')
    @yield('pageLinks')
</head>

<body>
    @include('includes.topbar')

    @yield('content')

    @include('includes.footer')
    @include('includes.script')
    @yield('pageScripts')
</body>

</html>
