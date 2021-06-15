<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Track Shortage</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link rel="icon" href="{{asset('image/Logo.gif')}}" type="image/gif" sizes="16x16">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/track-shortage.css') }}" rel="stylesheet">
</head>
<body>
<div class="container">
    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="{{route('register')}}">
            <img src="{{asset('image/Logo.png')}}" alt="Logo" class="img img-responsive logo-image">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
            </ul>
            <ul class="navbar-nav ">
                <li class="nav-item">
                    <a class="nav-link {{ (request()->is('/')) ? 'active-menu' : '' }}" href="{{route('register')}}">Home <span class="sr-only">(current)</span></a>
                </li>
                {{--                <li class="nav-item">--}}
                {{--                    <a class="nav-link" href="{{route('submit')}}">Submit</a>--}}
                {{--                </li>--}}
                {{--                <li class="nav-item">--}}
                {{--                    <a class="nav-link" href="#">Verify</a>--}}
                {{--                </li>--}}
                <li class="nav-item">
                    <a class="nav-link {{ (request()->is('faq')) ? 'active-menu' : '' }}" href="{{route('faq')}}">FAQ</a>
                </li>
                <li class="nav-item">
                    <a href="https://www.patreon.com/TrackShortage" target="_blank" class="btn btn-donate">
                        Donate
                    </a>
                </li>
            </ul>
        </div>
    </nav>

</div>
