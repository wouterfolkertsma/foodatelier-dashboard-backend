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



    <footer class= "uk-animation-fade">

        <div class="logo_company">
            <B>Developed By:</B><br><br>
            <img src="/images/company-logo.png" width= "160px" height="auto">
        </div>

        <div class= "footer_address">
            <B>Client Address:</B><br><br>
            Hulsmaatstraat 41<br>
            7523 WB Enschede<br>
            The Netherlands
        </div>

        <div class= "footer_details">
            <B>Client Details:</B><br><br>
            <a class ="sublink" href="https://hetfoodatelier.nl/"target="_blank">hetfoodatelier.nl</a><br>
            info@hetfoodatelier.nl
        </div>

        <div class="footer_project">
            <B>Project:</B><br><br>
            CMD2021 | Minor Digital Product Lab<br>
            Hanzehogeschool Groningen -<br>
            University of applied sciences
        </div>

    </footer>

    <!------------- scrips --------------->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>