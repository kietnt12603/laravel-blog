<!doctype html>
<html lang="en">

<head>
    @include('client.blocks.header')
</head>

<body>
    {{-- @include('client.blocks.main') --}}
    @yield('ClientMain')
    <!-- /.site-footer -->


    @include('client.blocks.footer')
</body>

</html>
