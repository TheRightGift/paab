<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Paab</title>

        @vite('resources/js/app.js')
    </head>
    <body>
        <div id="home">
            <form action="/login" method="POST">
            @csrf
                <input type="text" name="email" />
                <input type="text" name="password" />
                <input type="submit" value="submit"/>
            </form>

        </div>
    </body>
    
</html>
