<!doctype html>
<html dir="<?php echo App::getLocale()=='ar'? 'rtl' : 'ltr' ?>"
    lang="<?php echo App::getLocale()=='ar'? 'ar' : 'en' ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}

    <!-- Fonts -->
    {{-- <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> --}}

    <!-- Styles -->
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}

    {{-- <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.0/css/perfect-scrollbar.min.css"> --}}
    
        @yield('header')

</head>

<body>

    <div id="app">

        @yield('body')


        @if(auth()->check())
        <div id="chat-widget">
            <chat-app :user="{{auth()->user()}}" />
        </div>
        <!-- /#chat-widget -->
        @endif
    </div>




    <script src='{{asset($asset."/js/app.js?ver=".$ver)}}'  type='text/javascript'></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.0/perfect-scrollbar.min.js"></script>

    <!-- jQuery -->
    

    <script>
        
        window.language = '{!! app()->getLocale() !!}';    
        
        
        $(document).ready(function(){

        });/* /ready() */

    </script>

    @yield('footer')
</body>

</html>