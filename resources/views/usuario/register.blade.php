@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        @if(isset($usuario))
                            <i class="glyphicon glyphicon-edit"></i> Editar
                        @else
                            <i class="glyphicon glyphicon-plus"></i> Nuevo
                        @endif
                    </h4>
                </div>
                <div class="panel-body">
                    <form id="frmUsuario" action="{{ route('usuarios.store') }}" class="form-horizontal" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" id="id" value="{{ isset($usuario) ? $usuario->id : 0  }}"/>
                        <div class="form-group {{ $errors->has('id_personal') ? 'has-error' : '' }}">
                            <label for="id_personal" class="control-label col-xs-4">Personal</label>
                            <div class="col-xs-8">
                                <select autofocus name="id_personal" id="id_personal" class="form-control">
                                    <option value="0">-- SELECCIONE --</option>
                                    @foreach($personal as $per)
                                        <option data-nombres="{{ $per->nombres }}" data-email="{{ $per->email }}" value="{{ $per->id_personal }}">{{ $per->nombres.' '.$per->apellidos }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('id_personal'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('id_personal') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label for="name" class="control-label col-xs-4">Nombre</label>
                            <div class="col-xs-8">
                                <input required maxlength="30" type="text" class="form-control" name="name" id="name" value="{{ isset($usuario) ? $usuario->name : '' }}" />
                                @if($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                            <label for="name" class="control-label col-xs-4">Usuario</label>
                            <div class="col-xs-8">
                                <input required maxlength="150" type="text" class="form-control" name="email" id="email" value="{{ isset($usuario) ? $usuario->email : '' }}" />
                                @if($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        @if(!isset($usuario))
                            <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                                <label for="password" class="control-label col-xs-4">Contraseña</label>
                                <div class="col-xs-8">
                                    <input type="password" class="form-control" name="password" id="password"  required />
                                    @if($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        @endif
                        <div class="form-group {{ $errors->has('id_rol') ? 'has-error' : '' }}">
                            <label for="id_rol" class="control-label col-xs-4">Rol</label>
                            <div class="col-xs-8">
                                <select name="id_rol" id="id_rol" class="form-control">
                                    <option value="0">-- SELECCIONE --</option>
                                    @foreach($roles as $rol)
                                        <option value="{{ $rol->id_rol }}">{{ $rol->nombre }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('id_rol'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('id_rol') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="estado" class="control-label col-xs-4">Estado</label>
                            <div class="col-xs-8">
                                <select name="estado" id="estado" class="form-control">
                                    <option value="ACTIVO">ACTIVO</option>
                                    <option value="INACTIVO">INACTIVO</option>
                                    <option value="BLOQUEADO">BLOQUEADO</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="panel-footer">
                    <a href="{{ request()->headers->get('referer') }}" class="btn btn-link" type="button"><i class="glyphicon glyphicon-arrow-left"></i> Atras</a>
                    <button onclick="document.getElementById('frmUsuario').submit()" class="btn btn-success pull-right" type="button"><i class="glyphicon glyphicon-save"></i> Guardar</button>
                </div>
            </div>
        </div>
    </div>
    @isset($usuario)
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-warning">
                    <div class="panel-heading">
                        <h4 class="panel-title"><i class="glyphicon glyphicon-certificate"></i> Cambiar Contraseña</h4>
                    </div>
                    <div class="panel-body">
                        <form id="frmPassword" action="{{ route('usuarios.updatePassword') }}" method="post" class="form-horizontal {{ $errors->has('password') ? 'has-error' : '' }}">
                            {{ csrf_field() }}
                            <input type="hidden" name="id" id="id" value="{{ isset($usuario) ? $usuario->id : 0  }}"/>
                            <div class="form-group">
                                <label for="password" class="control-label col-xs-4">Contraseña</label>
                                <div class="col-xs-8">
                                    <input type="password" class="form-control" name="password" id="password"  required />
                                    @if($errors->has('passwordx'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="panel-footer" style="padding: 25px;">
                        <button class="btn btn-warning pull-right" type="button" onclick="document.getElementById('frmPassword').submit()"> Cambiar contraseña</button>
                    </div>
                </div>
            </div>
        </div>
    @endisset
</div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            @isset($usuario)
                selectOption(['#id_personal','#id_rol','#estado'],[{{ $usuario->id_personal }}, {{ $usuario->id_rol }}, '{{ $usuario->estado }}']);
            @endisset
            $('#id_personal').on('change', function (e) {
                var optionSelect = $(this).find('option:selected');
                var data = $(optionSelect).data();
                $('#name').val(data.nombres);
                $('#email').val(data.email);
            });
        });
    </script>
@endsection