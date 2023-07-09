<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="referrer" content="no-referrer-when-downgrade">
    <meta name="robots" content="all">
    <title>{{$pageTitle ?? $template}}</title>
    <!-- SEO -->
    <meta name="keywords" content="{{('Brand Website of '.($pageTitle ?? $template) )}}">
    <meta name="description" content="{{ $meta['description'] }}">
    <!-- Open Graph -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->full() }}">
    <meta property="og:title" content="{{ $pageTitle ?? $template }}">
    <meta property="og:description" content="{{ $meta['description'] }}">
    <meta property="og:image" content="{{ url()->full().$meta['image'] }}">
    <meta content="400" property="og:image:width">
    <meta content="400" property="og:image:height">
    <meta content="{{ ('An image of '. ($pageTitle ?? $template) ) }}" property="og:image:alt">

    <link rel="shortcut icon" href="{{ ('/media/tenants/'.$tenantID.'/img/favicon.png') }}" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@100;200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">

    
    <link rel="stylesheet" href="/css/materialize.min.css">
    <link rel="stylesheet" href="/css/paab.css">
    <link rel="stylesheet" href="{{ ('/css/'.$templateCSS) }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <div id="app" data-template-prop="{{$template_id}}" data-folder-prop="{{strtolower($template)}}">
        <physician-{{$template_id}}-website-component userSubscribed="{{$userSubscribed ?? ''}}" user_id="{{$user_id}}" email="{{$email}}" can="{{$can}}" social="{{$socials ?? null}}" tenant='{{$tenantID ?? null}}' preview='{{$preview ?? 0}}' title='{{$title ?? null}}' template_id="{{$template_id}}" template="{{$template}}" user="{{$user ?? ''}}"></physician-website-component>
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
