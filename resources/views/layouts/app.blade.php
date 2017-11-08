<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="shorcut icon" type="image/x-icon" href="{{ asset('img/favicon.png') }}">
    <!-- Styles -->
    <link href="{{ asset('plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/bs-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet">
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
    </style>
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
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        @if(!Auth::guest())
                            <li class="dropdown">
                                <a href="#" class="dropdown" data-toggle="dropdown" role="button"
                                   aria-expanded="false">
                                    <i class="glyphicon glyphicon-star-empty"></i> Sistema <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    </li><li><a href="{{ route('roles') }}"><i class="glyphicon glyphicon-certificate"></i> Roles</a></li>
                                    <li><a href="{{ route('usuarios') }}"><i class="glyphicon glyphicon-lock"></i> Usuarios</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown" data-toggle="dropdown" role="button"
                                   aria-expanded="false">
                                    <i class="glyphicon glyphicon-cog"></i> Mantenimiento <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ route('areas') }}"><i class="glyphicon glyphicon-list-alt"></i> Áreas</a></li>
                                    <li><a href="{{ route('personal') }}"><i class="glyphicon glyphicon-user"></i> Personal</a>
                                    <li><a href="{{ route('maquinarias') }}"><i class="glyphicon glyphicon-pushpin"></i> Maquinaria</a></li>
                                    <li><a href="{{ route('materiales') }}"><i class="glyphicon glyphicon-th-list"></i> Materiales</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" role="button" data-toggle="dropdown" aria-expanded="false"
                                   class="dropdown">
                                    <i class="glyphicon glyphicon-barcode"></i> Registros <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ route('clientes.create') }}"><i class="glyphicon glyphicon-briefcase"></i> Nuevo Cliente</a></li>
                                    <li><a href="{{ route('clientes.index') }}"><i class="glyphicon glyphicon-menu-hamburger"></i> Lista de Clientes</a></li>
                                    <li class="divider"></li>
                                    <li><a href="{{ route('registros.create') }}"><i class="glyphicon glyphicon-plus"></i> Nuevo registro </a></li>
                                    <li><a href="{{ route('registros') }}"><i class="glyphicon glyphicon-list"></i> Lista de Registros</a></li>
                                </ul>
                            </li>
                        @endif
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
    <script src="{{ asset('plugins/validate/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('plugins/validate/messages_es_PE.js') }}"></script>
    <script src="{{ asset('js/functions.js') }}"></script>
    @yield('scripts')
</body>
</html>
