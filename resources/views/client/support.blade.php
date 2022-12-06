<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>PaaB: People as a Brand - Support</title>
        <link rel="shortcut icon" href="{{ asset('/media/img/logo.png') }}" type="image/x-icon">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">


        <link rel="stylesheet" href="{{ asset('css/materialize.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/paab.css') }}">
        <link rel="stylesheet" href="{{ asset('fonts/material-icons.css') }}">
    </head>
    <body>

        <div id="app">
            <client-support-component />
        </div>


        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
        <script src="{{ asset('js/materialize.min.js') }}"></script>
        <script src="{{ asset('js/paab.js') }}"></script>
    </body>
</html>
