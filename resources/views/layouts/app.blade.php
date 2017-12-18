<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="shorcut icon" type="image/x-icon" href="{{ asset('img/logo-cavenago.jpg') }}">
    <!-- Styles -->
    <link href="{{ asset('plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/bs-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/timepicker/css/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        .input-group, .col-xs-12 > .btn-group {
            margin-bottom: 15px;
        }
        .has-error .select2-container .select2-selection--single{
            border: 1px solid #a94442;
        }
        .radio-inline>label{
            cursor: pointer;
        }
        .navbar-brand img {
            height: 50px;
            width: auto;
            margin-top: -15px;
        }
        .no-padding{
            padding: 0px;
        }
    </style>
    @yield('headStyles')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img src="{{ asset('img/logo-cavenago.jpg') }}"/>
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="{{ back()->getTargetUrl() }}"><i class="glyphicon glyphicon-arrow-left"></i> Atras</a></li>
                        <?=getLinksHTML()?>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Iniciar Sesión</a></li>
                            <!--<li><a href="{{ route('register') }}">Registro</a></li>-->
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            <i class="glyphicon glyphicon-remove"></i> Salir
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        <div style="padding-top: 60px">
            @yield('content')
            <div class="container" id="error-div"></div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/bs-dialog.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('plugins/bs-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('plugins/bs-datepicker/bootstrap-datepicker.es.min.js') }}"></script>
    <script src="{{ asset('plugins/timepicker/js/bootstrap-timepicker.js') }}"></script>
    <script src="{{ asset('plugins/validate/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('plugins/validate/messages_es_PE.js') }}"></script>
    <script src="{{ asset('js/functions.js') }}"></script>
    @yield('scripts')
</body>
</html>
