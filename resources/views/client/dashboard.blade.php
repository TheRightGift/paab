<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ auth()->user()->firstname.' ' .auth()->user()->lastname ?? '' }} | Dashboard</title>
        @vite('resources/js/app.js')
    </head>
    <body>
        <div id="clientDashboard"></div>
    </body>
</html>
