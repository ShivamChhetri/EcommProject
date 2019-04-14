<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{config('app.name','ecomapp')}}</title>

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
        <!-- Fonts -->
        {{-- <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">   --}}
        <style>
            .grid{
                display: grid;
                grid-template-columns: repeat(8,1fr);
                text-align: center;
                /* border:1px solid black; */
            }
            .grid-item{
                border:1px solid black;
            }
        </style>
    </head>
    <body>
        @include('inc.messages')
        @yield('content')
    </body>
</html>