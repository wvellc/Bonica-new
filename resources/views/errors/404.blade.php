<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ Config::get('constants.APP_NAME') }}</title>

        <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('favicons/apple-icon-57x57.png')}}">
        <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('favicons/apple-icon-60x60.png')}}">
        <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('favicons/apple-icon-72x72.png')}}">
        <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('favicons/apple-icon-76x76.png')}}">
        <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('favicons/apple-icon-114x114.png')}}">
        <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('favicons/apple-icon-120x120.png')}}">
        <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('favicons/apple-icon-144x144.png')}}">
        <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('favicons/apple-icon-152x152.png')}}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicons/apple-icon-180x180.png')}}">
        <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('favicons/android-icon-192x192.png')}}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicons/favicon-32x32.png')}}">
        <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('favicons/favicon-96x96.png')}}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicons/favicon-16x16.png')}}">
        <link rel="manifest" href="favicons/manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="favicons/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Maven+Pro:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
        <style>
            body {
                font-family: 'Maven Pro', sans-serif;
                margin: 0;
                padding: 0;
            }
            .justin-banner {
                -webkit-align-items: center;
                -ms-flex-align: center;
                align-items: center;
                background-color:#FCF5F4;
                display: -webkit-flex;
                display: -ms-flexbox;
                display: flex;
                -webkit-flex-direction: column;
                -ms-flex-direction: column;
                flex-direction: column;
                height: 100vh;
                -webkit-justify-content: center;
                -ms-flex-pack: center;
                justify-content: center;
            }
            .justin-banner img{
                max-width: 270px;
                width: 100%;
                margin: 0 auto;
                padding: 0 10px;
            }
            .justin-banner h1{
                color: #601F2D ;
                font-weight: bold;
                text-align: center;
                margin-top: 30px;
            }
            .btn-primary{
                background-color: #C36D5F !important;
                border-color: #C36D5F !important;
                color: #FFFFFF;
                border-radius: 0px;
                font-size: 18px;
                font-weight: 600;
                line-height: normal;
                letter-spacing: normal;
                padding: 10px 20px;
                text-align: center;
                text-decoration: none;
            }
            h2{
                text-align: center;
                font-weight: 500;
                font-size: 20px;
                line-height: 1.5;
            }
        </style>
    </head>
    <body class="justin-banner text-center">
        <img src="{{ asset('images/logo.svg') }}">
        <h1>404 ERROR | Page Not Found </h1>
        <h2>
            We're sorry, but the page you requested could not be found<br/>
            Please go back to the homepage
        </h2>
        <a href="{{ route('frontend.home') }}" class="btn btn-primary">GO BACK</a>
    </body>
</html>
