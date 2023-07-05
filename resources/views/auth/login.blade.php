<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta name="keywords" content="Website builder, Physician Website Builder, Personal Website Builder, Physician Brand Website">
    <meta name="description" content="White Coat Domain - A dose of your medical story - building a brand around your medical career">
    <meta name="referrer" content="no-referrer-when-downgrade">
    <meta name="robots" content="all">
    <meta content="WhiteCoatDomain" property="og:site_name">
    <meta content="website" property="og:type">
    <meta content="https://whitecoatdomain.com/" property="og:url">
    <meta content="White Coat DOmain - is a fast-growing Peopl-as-a-Brand solution that helps physician own and easy to setup, easy to manage and very financial comfortable web presence for showcasing ther thriving careers." property="og:title">
    <meta content="White Coat Domain - A dose of your medical story - building a brand around your medical career. We provide medical practitioners with a web presence to promote and showcase their thriving career." property="og:description">
    <meta content="https://whitecoatdomain.com/media/img/whiteCoatDomainSlogan.png" property="og:image">
    <meta content="400" property="og:image:width">
    <meta content="400" property="og:image:height">
    <meta content="An image of the White Coat Domain logo" property="og:image:alt">

    
    <title>{{config('app.name')}} - Login</title>
    <link rel="shortcut icon" href="{{ asset('/media/img/wcdFavicon.jpg') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">


    <link rel="stylesheet" href="{{ asset('css/materialize.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/paab.css') }}">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>

    <div id="app">
        <login-component/>
    </div>
    
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('js/materialize.min.js') }}"></script>
    <script src="{{ asset('js/paab.js') }}"></script>
</body>
</html>