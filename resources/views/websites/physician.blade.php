<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$pageTitle ?? $template}}</title>
    <link rel="shortcut icon" href="{{ ('/media/tenants/'.$tenantID.'/img/favicon.png') }}" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@100;200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700&display=swap" rel="stylesheet">

    <!-- <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;1,700&family=Open+Sans:wght@300;400;500&family=Poppins:wght@200;300;400;500;600&display=swap" rel="stylesheet"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">

    
    <link rel="stylesheet" href="/css/materialize.min.css">
    <link rel="stylesheet" href="/css/paab.css">
    <link rel="stylesheet" href="{{ ('/css/'.$templateCSS) }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <div id="app">
        <physician-website-component user_id="{{$user_id}}" email="{{$email}}" can="{{$can}}" social="{{$socials ?? null}}" tenant='{{$tenantID ?? null}}' preview='{{$preview ?? 0}}' title='{{$title ?? null}}' template="{{$template}}" user="{{$user ?? ''}}"></physician-website-component>
    </div>

    <script src="/js/app.js"></script>
    <script src="/js/jquery-3.6.0.min.js"></script>
    <script src="/js/materialize.min.js"></script>
    <script src="/js/paab.js"></script>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v16.0" nonce="WtqDSqzj"></script>
    <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
    <script async src="//www.instagram.com/embed.js"></script>
    <script async src="https://www.tiktok.com/embed.js"></script>
    
    <script>
        var dropdowns = document.querySelectorAll('.dropdown-trigger')
        for (var i = 0; i < dropdowns.length; i++){
            M.Dropdown.init(dropdowns[i]);
        }
    </script>
</body>
</html>
