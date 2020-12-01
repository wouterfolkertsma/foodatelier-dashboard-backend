<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"/>
    <title>Foodatelier - @yield('title')</title>
</head>
<body>

    @if (auth()->user()->isEmployee())
        @include('sidebar.admin')
        @include('navbar.base')
    @endif

    @if (auth()->user()->isClient())
        @include('sidebar.client')
    @endif

        
    <div class="container container-main">
        @if ($errors->any())
            <div class="uk-alert-danger" uk-alert>
                <a class="uk-alert-close" uk-close></a>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </div>
    

    <!------------- scrips --------------->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
