<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"/>
    <title>App Name - @yield('title')</title>
</head>
<body>
    @yield('sidebar')

    <div class="container">
        @yield('content')
    </div>

    <!------------- scrips --------------->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>