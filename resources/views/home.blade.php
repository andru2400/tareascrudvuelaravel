<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Laravel - Componentes Vue Js</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/toastr.css') }}">

    </head>
    <body>
                {{--  --}}
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <div id="app">
                                <h1>Tareas</h1>
                                <tarea-component></tarea-component>                                                                
                            </div>                            
                        </div>                        
                    </div>
                </div>
                {{--  --}}
                <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
