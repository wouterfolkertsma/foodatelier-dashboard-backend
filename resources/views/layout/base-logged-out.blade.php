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
    <div class="container">
        @yield('content')
    </div>

    <div class="footer">
        <div class="innter_footer">
            <div class="logo_container">
                <img class="logo_container" src="/../images/company-logo.png" width= "160px" height="auto">
            </div>

            <div class="footer_third">
 
                
            </div>

        </div>
    </div>

    <!------------- scrips --------------->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>