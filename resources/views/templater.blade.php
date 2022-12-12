<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Paab</title>
    </head>
    <body>
        <div id="app">
            <!-- <img src="{{tenant_asset('img/2XqfXZIdKMyx1W0i7MOo5CVQB2ZC9ZTLqFoS0W0K.png')}}" /> -->
            <div id="{{ tenant('id') ?? '' }}"></div>
        </div>
    </body>
</html>
