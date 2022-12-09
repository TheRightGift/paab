<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Paab</title>

        <!-- @vite(['resources/css/app.css', 'resources/js/app.js']) -->
    </head>
    <body>
        <!-- nickname="'{{ $userNickname ?? '' }}'" -->
        <div id="app">
            <div id="{{ tenant('id') ?? '' }}"></div>
        </div>
    </body>
</html>
