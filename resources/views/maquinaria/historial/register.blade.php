@extends('layouts.app')
@section('headStyles')

@endsection
@section('content')
    <div class="container">
        <div class="col-xs-12">
            <h4 class="page-header">
                @if(isset($entity))
                    <i class="glyphicon glyphicon-edit"></i> Editar horometro
                @else
                    <i class="glyphicon glyphicon-plus"></i> Nuevo horometro
                @endif
            </h4>
        </div>
        <div class="col-xs-12 col-md-4">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="glyphicon glyphicon-info-sign"></i> Información</h4>
                </div>
                <div class="panel-body">
                    <table>
                        <tr>
                            <td style="width: 55%">NOMBRE: </td>
                            <td>{{ $maquinaria->nombre }}</td>
                        </tr>
                        <tr>
                            <td style="width: 55%">MARCA: </td>
                            <td>{{ $maquinaria->marca }}</td>
                        </tr>
                        <tr>
                            <td style="width: 55%">MODELO: </td>
                            <td>{{ $maquinaria->modelo }}</td>
                        </tr>
                        <tr>
                            <td style="width: 55%">SERIE CHASIS: </td>
                            <td>{{ $maquinaria->serie_chasis }}</td>
                        </tr>
                        <tr>
                            <td style="width: 55%">SERIE MOTOR: </td>
                            <td>{{ $maquinaria->serie_motor }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-8">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="glyphicon glyphicon-time"></i> Información de Horometro</h4>
                </div>
                <div class="panel-body">
                    <form id="frm-historial" method="post" action="{{ isset($entity) ? route('maquinarias.historial.update') : route('maquinarias.historial.store') }}" class="form-horizontal">
                        {{ csrf_field() }}
                        <input type="hidden" name="id_maquinaria" id="id_maquinaria" value="{{ $maquinaria->id_maquinaria }}">
                        <div class="row">
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group {{ $errors->has('fecha')?'has-error':'' }}">
                                    <label for="fecha" class="control-label col-xs-4">Fecha</label>
                                    <div class="col-xs-8">
                                        <div class="input-group">
                                            <input data-toggle="datepicker" name="fecha" id="fecha" type="text" class="form-control">
                                            <span class="input-group-addon">
                                                <i class="glyphicon glyphicon-calendar"></i>
                                            </span>
                                        </div>
                                        @if($errors->has('fecha'))
                                            <span class="help-block"><strong>{{ $errors->first('fecha') }}</strong></span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group {{ $errors->has('horometro') ?'has-error':'' }}">
                                    <label for="horometro" class="control-label col-xs-4">Horometro</label>
                                    <div class="col-xs-8">
                                        <div class="input-group">
                                            <input name="horometro" id="horometro" type="text" class="form-control">
                                            <span class="input-group-addon">
                                                <i class="glyphicon glyphicon-time"></i>
                                            </span>
                                        </div>
                                        @if($errors->has('horometro'))
                                            <span class="help-block"><strong>{{ $errors->first('horometro') }}</strong></span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="form-group {{ $errors->has('hinicio')?'has-error':'' }}">
                                    <label for="hinicio" class="control-label col-xs-4">Hora inicio</label>
                                    <div class="col-xs-8">
                                        <input type="text" class="form-control" name="hinicio" id="hinicio" />
                                        @if($errors->has('hinicio'))
                                            <span class="help-block"><strong>{{ $errors->first('hinicio') }}</strong></span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group {{ $errors->has('htermino')?'has-error':'' }}">
                                    <label for="htermino" class="control-label col-xs-4">Hora termino</label>
                                    <div class="col-xs-8">
                                        <input type="text" class="form-control" name="htermino" id="htermino" />
                                        @if($errors->has('htermino'))
                                            <span class="help-block"><strong>{{ $errors->first('htermino') }}</strong></span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="panel-footer">
                    <a href="{{ back()->getTargetUrl() }}" class="btn btn-link"><i class="glyphicon glyphicon-arrow-left"></i> Atras</a>
                    <button class="btn btn-success pull-right" type="button" onclick="document.getElementById('frm-historial').submit()"><i
                                class="glyphicon glyphicon-save"></i> Guardar
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')

@endsection