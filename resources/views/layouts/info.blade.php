<!DOCTYPE html>
<html>
<head>
<title>@yield('title')</title>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" />
    <meta name="author" content="" />
    <meta name="keyword" content="" />
    <meta name="description" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{ asset('css/material-icons.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/animate.css') }}" />
            <link rel="stylesheet" href="{{ asset('css/bootstrap-theme-cosmo-indigo-rounded.css') }}" />
                <script type="text/javascript" src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
                </head>
                <body>
                <div id="topbar" class="navbar navbar-expand-md fixed-top navbar-dark bg-primary">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="/">
                            <img class="img-responsive" src="{{ asset('images/logo.png') }}" /> {{ config('app.name') }}
                        </a>
                    </div>
                </div>
                <div id="main-content">
                    <div id="page-content">
                        @yield('content')
                    </div>
                </div>
                @include('appfooter')
                <script type="text/javascript" src="{{ asset('js/popper.js') }}"></script>
                <script type="text/javascript" src="{{ asset('js/bootstrap-4.3.1.min.js') }}"></script>
                </body>
                </html>