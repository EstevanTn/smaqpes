@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            @if(isset($cliente))
                                <i class="glyphicon glyphicon-edit"></i> Editar
                            @else
                                <i class="glyphicon glyphicon-plus"></i> Nuevo
                            @endif
                        </h4>
                    </div>
                    <div class="panel-body">
                        <form id="frmCliente" method="post" action="{{ isset($cliente) ? route('clientes.update') : route('clientes.store') }}" class="form-horizontal">
                            {{ csrf_field() }}
                            <div class="col-xs-12 col-md-6">
                                <legend class="text-center">Datos del cliente</legend>
                                <input type="hidden" name="id_cliente" id="id_cliente" value="{{ isset($cliente) ? $cliente->id_cliente : old('id_cliente') }}" />
                                <input type="hidden" name="id_persona" id="id_persona" value="{{ isset($cliente) ? $cliente->id_persona : old('id_persona') }}" />
                                <div class="form-group {{ $errors->has('ruc') ? 'has-error' : '' }}">
                                    <label for="ruc" class="control-label col-xs-4">RUC</label>
                                    <div class="col-xs-8">
                                        <input value="{{ isset($cliente) ? $cliente->ruc : old('ruc') }}" type="text" class="form-control" maxlength="11" id="ruc" name="ruc" />
                                        @if($errors->has('ruc'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('ruc') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group {{$errors->has('razon_social') ? 'has-error' : ''}}">
                                    <label for="razon_social" class="control-label col-xs-4">Razon Social</label>
                                    <div class="col-xs-8">
                                        <input value="{{ isset($cliente) ? $cliente->razon_social : old('razon_social') }}" class="form-control" type="text" maxlength="150" id="razon_social" name="razon_social">
                                        @if($errors->has('razon_social'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('razon_social') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group {{$errors->has('nombre_comercial') ? 'has-error' : ''}}">
                                    <label for="nombre_comercial" class="control-label col-xs-4">Nombre Comercial</label>
                                    <div class="col-xs-8">
                                        <input value="{{ isset($cliente) ? $cliente->nombre_comercial : old('nombre_comercial') }}" class="form-control" type="text" maxlength="150" id="nombre_comercial" name="nombre_comercial">
                                        @if($errors->has('nombre_comercial'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('nombre_comercial') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group {{$errors->has('direccion_cliente') ? 'has-error' : ''}}">
                                    <label for="direccion_cliente" class="control-label col-xs-4">Dirección cliente</label>
                                    <div class="col-xs-8">
                                        <input value="{{ isset($cliente) ? $cliente->direccion_cliente : old('direccion_cliente') }}" class="form-control" type="text" maxlength="150" id="direccion_cliente" name="direccion_cliente">
                                        @if($errors->has('direccion_cliente'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('direccion_cliente') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->has('estado') ? 'has-error' : '' }}">
                                    <label for="estado" class="control-label col-xs-4">Estado</label>
                                    <div class="col-xs-8">
                                        <select name="estado" id="estado" class="form-control">
                                            <option value="A">ACTIVO</option>
                                            <option value="I">INACTIVO</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <legend class="text-center">Datos del representante</legend>
                                <div class="form-group {{ $errors->has('tipo_documento') ? 'has-error' : '' }}">
                                    <label for="tipo_documento" class="control-label col-xs-4">Tipo Documento</label>
                                    <div class="col-xs-8">
                                        <select name="tipo_documento" id="tipo_documento" class="form-control">
                                            <option value="0">-- SELECCIONE --</option>
                                            @foreach($tipos_documentos as $tipo)
                                                <option value="{{ $tipo->id_tipo_documento }}">{{ $tipo->siglas }}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('tipo_documento'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('tipo_documento') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->has('numero_documento') ? 'has-error' : '' }}">
                                    <label for="numero_documento" class="control-label col-xs-4">Número Documento</label>
                                    <div class="col-xs-8">
                                        <input value="{{ isset($cliente) ? $cliente->numero_documento : old('numero_documento') }}" type="text" name="numero_documento" id="numero_documento" class="form-control" />
                                        @if($errors->has('numero_documento'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('numero_documento') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->has('nombres') ? 'has-error' : '' }}">
                                    <label for="nombres" class="control-label col-xs-4">Nombres</label>
                                    <div class="col-xs-8">
                                        <input type="text" class="form-control" name="nombres" id="nombres" value="{{ isset($cliente) ? $cliente->nombres : old('nombres') }}" />
                                        @if($errors->has('nombres'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('nombres') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->has('apellidos') ? 'has-error' : '' }}">
                                    <label for="apellidos" class="control-label col-xs-4">Apellidos</label>
                                    <div class="col-xs-8">
                                        <input type="text" class="form-control" name="apellidos" id="apellidos" value="{{ isset($cliente) ? $cliente->apellidos : old('apellidos') }}" />
                                        @if($errors->has('apellidos'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('apellidos') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->has('direccion') ? 'has-error' : '' }}">
                                    <label for="direccion" class="control-label col-xs-4">Dirección</label>
                                    <div class="col-xs-8">
                                        <input type="text" class="form-control" name="direccion" id="direccion" value="{{ isset($cliente) ? $cliente->direccion : old('direccion') }}" />
                                        @if($errors->has('direccion'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('direccion') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                    <label for="email" class="control-label col-xs-4">E-Mail</label>
                                    <div class="col-xs-8">
                                        <input type="email" class="form-control" name="email" id="email" value="{{ isset($cliente) ? $cliente->email : old('email') }}" />
                                        @if($errors->has('email'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->has('fecha_nacimiento') ? 'has-error' : '' }}">
                                    <label for="fecha_nacimiento" class="control-label col-xs-4">Fecha Nacimiento</label>
                                    <div class="col-xs-8">
                                        <input data-toggle="datepicker" type="text" class="form-control" name="fecha_nacimiento" id="fecha_nacimiento" value="{{ isset($cliente) ? $cliente->fecha_nacimiento : old('fecha_nacimiento') }}" />
                                        @if($errors->has('fecha_nacimiento'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('fecha_nacimiento') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="panel-footer">
                        <a href="{{ back()->getTargetUrl() }}" class="btn btn-link"><i class="glyphicon glyphicon-arrow-left"></i> Atras</a>
                        <button onclick="document.getElementById('frmCliente').submit()" type="button" class="btn btn-success pull-right"><i class="glyphicon glyphicon-save"></i> Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function () {
            selectOption({
                tipo_documento: '{{ isset($cliente) ? $cliente->id_tipo_documento : old('tipo_documento', 0) }}',
                estado: '{{ isset($cliente) ? $cliente->estado : old('estado', 'A') }}'
            })
        });
    </script>
@endsection