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
