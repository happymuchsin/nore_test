<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    @include('tema.head')
</head>

<body>
    <div id="app">
        @include('tema.sidebar')

        <div id="main">
            @include('tema.header')
            
            @yield('content')

            @include('tema.footer')
        </div>
    </div>
    @include('tema.libscript')
    @yield('script')
</body>

</html>