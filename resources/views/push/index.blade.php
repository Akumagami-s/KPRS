<!DOCTYPE html>
 <html>
 <head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
     <meta name="csrf-token" content="{!! csrf_token() !!}">
     <title>Laravel </title>

     <link href="{{ mix('/css/app.css') }}" rel="stylesheet" >
     <!-- Scripts -->
     <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
            'pusherKey' => config('broadcasting.connections.pusher.key'),
            'pusherCluster' => config('broadcasting.connections.pusher.options.cluster')
        ]) !!};
     </script>
 </head>
 <body>
     <div id="app">
         <example-component> </example-component>
     </div>
     <script src="{{ mix('/js/app.js') }}"> </script>
 </body>
 </html>
