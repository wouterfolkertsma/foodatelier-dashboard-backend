<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"/>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="user-id" content="{{ Auth::user()->id }}">
    <title>Foodatelier - @yield('title')</title>
</head>
<body>

    @if (auth()->user()->isEmployee())
        @include('sidebar.admin')
        @include('navbar.base')
    @endif

    @if (auth()->user()->isClient())
        @include('sidebar.client')
        @include('navbar.base')
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

    <!------------- alerts --------------->
    @if (\Session::has('success'))
    <script type="application/javascript">
        window.jsAlertSuccess('{{ \Session::get('success') }}')
    </script>
    @endif

    @if (\Session::has('error'))
        <script type="application/javascript">
            window.jsAlertError('{{ \Session::get('error') }}')
        </script>
    @endif

    @if (\Session::has('successToast'))
        <script type="application/javascript">
            window.jsAlertSuccessToast('{{ \Session::get('successToast') }}')
        </script>
    @endif
</body>
</html>
