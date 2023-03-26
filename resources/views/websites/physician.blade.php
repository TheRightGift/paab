<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$pageTitle ?? $template}}</title>
    <link rel="shortcut icon" href="{{ ('/media/tenants/'.$tenantID.'/img/favicon.png') }}" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;1,700&family=Open+Sans:wght@300;400;500&family=Poppins:wght@200;300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">

    
    <link rel="stylesheet" href="{{ global_asset('css/materialize.min.css') }}">
    <link rel="stylesheet" href="{{ global_asset('css/'.$templateCSS) }}">
    <link rel="stylesheet" href="{{ global_asset('css/paab.css') }}">
    <link rel="stylesheet" href="{{ global_asset('css/auth.css') }}">
    <link rel="stylesheet" href="{{ global_asset('fonts/material-icons.css') }}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body style="width: 100%">
    <div id="app">
        <physician-website-component email="{{$email}}" can="{{$can}}" social="{{$socials ?? null}}" tenant='{{$tenantID ?? null}}' preview='{{$preview ?? 0}}' title='{{$title ?? null}}' template="{{$template}}" user="{{$user ?? ''}}"></physician-website-component>
    </div>

    <script src="{{ global_asset('js/app.js') }}"></script>
    <script src="{{ global_asset('js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ global_asset('js/materialize.min.js') }}"></script>
    <script src="{{ global_asset('js/paab.js') }}"></script>
    <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
    <script async src="https://www.tiktok.com/embed.js"></script>
    <script async src="//www.instagram.com/embed.js"></script>
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v16.0" nonce="Lvp1FF6L"></script>
</body>
</html>
