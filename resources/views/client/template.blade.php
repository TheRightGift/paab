<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{env('APP_NAME')}}: White Coat Domain - Templates</title>
    <link rel="shortcut icon" href="{{ asset('/media/img/wcdFavicon.jpg') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('css/materialize.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/paab.css') }}">
    <link rel="stylesheet" href="{{ asset('css/mails.css') }}">
    <link rel="stylesheet" href="{{ asset('fonts/material-icons.css') }}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>
<body class="dashboard">  
    <div id="app">
        <client-template-component />
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/jquery-3.5.1.min.js') }}" ></script>
    <script src="{{ asset('js/materialize.min.js') }}" ></script>
    <script src="{{ asset('js/paab.js') }}" ></script>
</body>
</html>