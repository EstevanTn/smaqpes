@extends('layouts.app')
@section('headStyles')
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/datatables.net-bs/css/dataTables.bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/iCheck/all.css') }}">
@endsection
@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    @if(!isset($registro))
                        <i class="glyphicon glyphicon-plus"></i> Nuevo registro
                    @else
                        <i class="glyphicon glyphicon-edit"></i> Editar registro
                    @endif
                </h4>
            </div>
            <div class="panel-body">
                <form id="frmRegistro" class="form-horizontal" method="post" action="{{ route('registros.store') }}">
                    {{ csrf_field() }}
                    <input type="hidden" id="id_registro" name="id_registro" value="{{ old('id_registro', isset($registro) ? $registro->id_registro : "0") }}" />
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group {{ $errors->has('id_cliente')||$errors->has('nombre_cliente') ? "has-error": "" }}">
                                <label for="id_cliente" class="control-label col-xs-4 col-sm-2">Cliente</label>
                                <div class="col-xs-3 col-sm-2">
                                    <input required readonly type="text" class="form-control" name="id_cliente" id="id_cliente" value="{{ old('id_cliente', isset($registro) ? $registro->id_cliente : "") }}">
                                </div>
                                <div class="col-xs-5 col-sm-8">
                                    <div class="input-group">
                                        <input required type="text" class="form-control" name="nombre_cliente" id="nombre_cliente" value="{{ old('nombre_cliente', isset($registro) ? $registro->nombre_cliente : "") }}">
                                        <span class="input-group-btn">
                                            <button data-target="#modal-cliente" data-toggle="modal" type="button" class="btn btn-default"><i class="glyphicon glyphicon-search"></i></button>
                                        </span>
                                    </div>
                                </div>
                                @if($errors->has('id_cliente'))
                                    <span class="help-block"><strong>{{$errors->first('id_cliente')}}</strong></span>
                                @endif
                                @if($errors->has('nombre_cliente'))
                                    <span class="help-block"><strong>{{$errors->first('id_cliente')}}</strong></span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group {{ $errors->has('id_maquinaria')||$errors->has('nombre_maquinaria') ? "has-error" : "" }}">
                                <label for="id_maquinaria" class="control-label col-xs-4">Maquinaria</label>
                                <div class="col-xs-8">
                                    <input type="hidden" class="form-control" name="id_maquinaria" id="id_maquinaria" value="{{ old('id_maquinaria', isset($registro) ? $registro->id_maquinaria : "0") }}" />
                                    <div class="input-group">
                                        <input required type="text" class="form-control" name="nombre_maquinaria" id="nombre_maquinaria" value="{{ old('nombre_maquinaria', isset($registro) ? $registro->nombre_maquinaria : "") }}" />
                                        <span class="input-group-btn">
                                            <button data-toggle="modal" data-target="#modal-maquinaria" type="button" class="btn btn-default"><i class="glyphicon glyphicon-search"></i></button>
                                        </span>
                                        @if($errors->has('id_maquinaria'))
                                            <span class="help-block"><strong>{{$errors->first('id_maquinaria')}}</strong></span>
                                        @endif
                                        @if($errors->has('nombre_maquinaria'))
                                            <span class="help-block"><strong>{{$errors->first('nombre_maquinaria')}}</strong></span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group {{ $errors->has('tipo_regsitro') ? "has-error":"" }}">
                                <label for="tipo_registro" class="control-label col-xs-4">Tipo Mantenimiento</label>
                                <div class="col-xs-8">
                                    <select min="1" name="tipo_registro" id="tipo_registro" class="form-control">
                                        <option value="0">-- SELECCIONE --</option>
                                        @foreach($tipos as $key => $tipo)
                                            <option data-index="{{ $key+1 }}" value="{{ $tipo->id_tipo_registro }}">{{ $tipo->nombre }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('tipo_registro'))
                                        <span class="help-block"><strong>{{$errors->first('tipo_registro')}}</strong></span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group {{ $errors->has("lugar") ? "has-error":"" }}">
                                <label for="lugar" class="control-label col-xs-4 col-sm-2">Lugar</label>
                                <div class="col-xs-8 col-sm-10">
                                    <input maxlength="350" type="text" class="form-control" id="lugar" name="lugar" value="{{ old('lugar', isset($registro) ? $registro->lugar : "") }}">
                                    @if($errors->has('lugar'))
                                        <span class="help-block"><strong>{{$errors->first('lugar')}}</strong></span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <div class="form-group {{ $errors->has('fecha_emision') ? "has-error":"" }}">
                                <label for="fecha_emision" class="control-label col-xs-4">Fecha Emisión</label>
                                <div class="col-xs-8">
                                    <div class="input-group">
                                        <input required data-toggle="datepicker" type="text" class="form-control" name="fecha_emision" id="fecha_emision" value="{{ old('fecha_emision', isset($registro) ? $registro->fecha_emision : "") }}">
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-default"><i class="glyphicon glyphicon-calendar"></i></button>
                                        </span>
                                    </div>
                                </div>
                                @if($errors->has('fecha_emision'))
                                    <span class="help-block"><strong>{{$errors->first('fecha_emision')}}</strong></span>
                                @endif
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <div class="form-group {{ $errors->has('total_horas') ? "has-error" : "" }}">
                                <label for="total_horas" class="control-label col-xs-4">Total Horas</label>
                                <div class="col-xs-8">
                                    <input required type="text" class="form-control" id="total_horas" name="total_horas" value="{{ old('total_horas', isset($registro) ? $registro->total_horas : "") }}">
                                </div>
                                @if($errors->has('total_horas'))
                                    <span class="help-block"><strong>{{$errors->first('total_horas')}}</strong></span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <div class="form-group {{ $errors->has('hora_inicio_mantto') ? "has-error" : ""}}">
                                <label for="hora_inicio_mantto" class="control-label col-xs-4">Hora Inicio Mantto</label>
                                <div class="col-xs-8">
                                    <input type="text" class="form-control" name="hora_inicio_mantto" id="hora_inicio_mantto" value="{{ old('hora_inicio_mantto', isset($registro) ? $registro->hora_inicio_mantto : "") }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <div class="form-group">
                                <label for="hora_termino_mantto" class="control-label col-xs-4">Hora Termino Mantto</label>
                                <div class="col-xs-8">
                                    <input type="text" class="form-control" id="hora_termino_mantto" name="hora_termino_mantto" value="{{ old('hora_termino_mantto', isset($registro) ? $registro->hora_termino_mantto : "") }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <div class="form-group {{ $errors->has('hora_salida_viaje')?"has-error":"" }}">
                                <label for="hora_salida_viaje" class="control-label col-xs-4">Hora Salida Viaje</label>
                                <div class="col-xs-8">
                                    <input type="text" class="form-control" name="hora_salida_viaje" id="hora_salida_viaje" value="{{ old('hora_salida_viaje', isset($registro) ? $registro->hora_salida_viaje : "") }}">
                                </div>
                                @if($errors->has('hora_salida_viaje'))
                                    <span class="help-block"><strong>{{$errors->first('hora_salida_viaje')}}</strong></span>
                                @endif
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <div class="form-group {{ $errors->has('hora_llegada_viaje')?"has-error":"" }}">
                                <label for="hora_llegada_viaje" class="control-label col-xs-4">Hora Llegada Viaje</label>
                                <div class="col-xs-8">
                                    <input type="text" class="form-control" id="hora_llegada_viaje" name="hora_llegada_viaje" value="{{ old('hora_llegada_viaje', isset($registro) ? $registro->hora_llegada_viaje : "") }}">
                                </div>
                                @if($errors->has('hora_llegada_viaje'))
                                    <span class="help-block"><strong>{{$errors->first('hora_llegada_viaje')}}</strong></span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <div class="form-group {{ $errors->has('horometro') ?"has-error":"" }}">
                                <label for="horometro" class="control-label col-xs-4">Horométro</label>
                                <div class="col-xs-8">
                                    <input required type="number" class="form-control" name="horometro" id="horometro" value="{{ old('horometro', isset($registro) ? $registro->horometro : "") }}">
                                </div>
                                @if($errors->has('horometro'))
                                    <span class="help-block"><strong>{{$errors->first('horometro')}}</strong></span>
                                @endif
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <div class="form-group {{ $errors->has('kilometraje') }}">
                                <label for="kilometraje" class="control-label col-xs-4">Kilometraje</label>
                                <div class="col-xs-8">
                                    <input required type="number" class="form-control" id="kilometraje" name="kilometraje" value="{{ old('kilometraje', isset($registro) ? $registro->kilometraje : "") }}">
                                </div>
                                @if($errors->has('kilometraje'))
                                    <span class="help-block"><strong>{{$errors->first('kilometraje')}}</strong></span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group">
                                <label for="estado_maquinaria" class="control-label col-xs-4">¿Como se encontró la maquinaria?</label>
                                <div class="col-xs-4 col-sm-3">
                                    <div class="radio-inline">
                                        <label>
                                            <input type="radio" value="O" name="estado_maquinaria" id="rbtnoperativo">
                                            Operativa
                                        </label>  
                                    </div>  
                                </div>
                                <div class="col-xs-4 col-sm-3">
                                    <div class="radio-inline">
                                        <label>
                                            <input checked="checked" type="radio" value="I" name="estado_maquinaria" id="rbtnoperativo">
                                            Inoperativa
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group {{ $errors->has('lugar_encontrado') ? "has-error":"" }}">
                                <label for="lugar_encontrado" class="control-label col-xs-4 col-sm-2">Lugar Encontrado</label>
                                <div class="col-xs-8 col-sm-10">
                                    <input list="default_lugar_encontrado" type="text" class="form-control" name="lugar_encontrado"
                                           id="lugar_encontrado" value="{{ old('lugar_encontrado', isset($registro) ? $registro->lugar_encontrado : "") }}">
                                    <datalist id="default_lugar_encontrado">
                                        <option value="TALLER DEL CLIENTE"></option>
                                    </datalist>
                                </div>
                                @if($errors->has('lugar_encontrado'))
                                    <span class="help-block"><strong>{{$errors->first('lugar_encontrado')}}</strong></span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group {{ $errors->has('id_operador')||$errors->has('nombre_operador')?"has-error":"" }}">
                                <label for="id_operador" class="control-label col-xs-4 col-sm-2">Operador</label>
                                <div class="col-xs-3 col-sm-2">
                                    <input required name="id_operador" id="id_operador" readonly type="text" class="form-control" value="{{ old('id_operador', isset($registro) ? $registro->id_operador : "") }}">
                                </div>
                                <div class="col-xs-5 col-sm-8">
                                    <div class="input-group">
                                        <input required name="nombre_operador" id="nombre_operador" type="text" class="form-control" value="{{ old('nombre_operador', isset($registro) ? $registro->nombre_operador : "") }}">
                                        <span class="input-group-btn">
                                            <button onclick="cliente.buttonPersonal(this)" data-role="operador" data-toggle="modal" data-target="#modal-personal" class="btn btn-default" type="button"><i class="glyphicon glyphicon-search"></i></button>
                                        </span>
                                    </div>
                                </div>
                                @if($errors->has('id_operador'))
                                    <span class="help-block"><strong>{{$errors->first('id_operador')}}</strong></span>
                                @endif
                                @if($errors->has('nombre_operador'))
                                    <span class="help-block"><strong>{{$errors->first('nombre_operador')}}</strong></span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group {{ $errors->has("id_mecanico")||$errors->has('nombre_mecanico')?"has-error":"" }}">
                                <label for="id_mecanico" class="control-label col-xs-4 col-sm-2">Mecanico</label>
                                <div class="col-xs-3 col-sm-2">
                                    <input required name="id_mecanico" id="id_mecanico" readonly type="text" class="form-control" value="{{ old('id_mecanico', isset($registro) ? $registro->id_mecanico : "") }}">
                                </div>
                                <div class="col-xs-5 col-sm-8">
                                    <div class="input-group">
                                        <input required name="nombre_mecanico" id="nombre_mecanico" type="text" class="form-control" value="{{ old('nombre_mecanico', isset($registro) ? $registro->nombre_mecanico : "") }}">
                                        <span class="input-group-btn">
                                            <button onclick="cliente.buttonPersonal(this)" data-role="mecanico" data-toggle="modal" data-target="#modal-personal" class="btn btn-default" type="button"><i class="glyphicon glyphicon-search"></i></button>
                                        </span>
                                    </div>
                                </div>
                                @if($errors->has('id_mecanico'))
                                    <span class="help-block"><strong>{{$errors->first('id_mecanico')}}</strong></span>
                                @endif
                                @if($errors->has('nombre_mecanico'))
                                    <span class="help-block"><strong>{{$errors->first('nombre_mecanico')}}</strong></span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group {{ $errors->has('id_responsable')||$errors->has('nombre_responsable') ? "has-error":"" }}">
                                <label for="id_responsable" class="control-label col-xs-4 col-sm-2">Jefe Responsable</label>
                                <div class="col-xs-3 col-sm-2">
                                    <input required name="id_responsable" id="id_responsable" readonly type="text" class="form-control" value="{{ old('id_responsable', isset($registro) ? $registro->id_responsable : "") }}">
                                </div>
                                <div class="col-xs-5 col-sm-8">
                                    <div class="input-group">
                                        <input required name="nombre_responsable" id="nombre_responsable" type="text" class="form-control" value="{{ old('nombre_responsable', isset($registro) ? $registro->nombre_responsable : "") }}">
                                        <span class="input-group-btn">
                                            <button onclick="cliente.buttonPersonal(this)" data-role="responsable" data-toggle="modal" data-target="#modal-personal" class="btn btn-default" type="button"><i class="glyphicon glyphicon-search"></i></button>
                                        </span>
                                    </div>
                                </div>
                                @if($errors->has('id_responsable'))
                                    <span class="help-block"><strong>{{$errors->first('id_responsable')}}</strong></span>
                                @endif
                                @if($errors->has('nombre_responsable'))
                                    <span class="help-block"><strong>{{$errors->first('nombre_responsable')}}</strong></span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group {{ $errors->has('observacion') ? "has-error":"" }}">
                                <label for="observacion" class="control-label col-xs-4 col-sm-2">Observación</label>
                                <div class="col-xs-8 col-sm-10">
                                    <textarea maxlength="500" name="observacion" id="observacion" cols="30" rows="3" class="form-control">{{ old('observacion', isset($registro) ? $registro->observacion : "") }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="form-group {{ $errors->has('estado') ? "has-error":"" }}">
                                <label for="estado" class="control-label col-xs-4">Estado</label>
                                <div class="col-xs-8">
                                    <select name="estado" id="estado" class="form-control">
                                        <option value="E">EN ESPERA</option>
                                        <option value="I">INICIADO</option>
                                        <option value="T">TERMINADO</option>
                                        <option value="B">BORRADOR</option>
                                    </select>
                                </div>
                                @if($errors->has('estado'))
                                    <span class="help-block"><strong>{{$errors->first('estado')}}</strong></span>
                                @endif
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="panel-footer">
                <a href="{{ route('registros') }}" class="btn btn-link"><i class="glyphicon glyphicon-arrow-left"></i> Atras</a>
                <button onclick="validate()" class="btn btn-success pull-right"><i class="glyphicon glyphicon-save"></i> Guardar</button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="modal fade" id="modal-cliente">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="close" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><i class="glyphicon glyphicon-list"></i> Clientes</h4>
                    </div>
                    <div class="modal-body">
                        <table class="table table-striped table-bordered table-hover" id="tb-cliente" style="width: 100%">
                            <thead>
                                <tr>
                                    <th style="width: 15%">RUC</th>
                                    <th style="width: 35%">Razon Social</th>
                                    <th style="width: 40%">Nombres y Apellidos</th>
                                    <th style="width: 10%">Seleccione</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                        <button role="submit" type="button" class="btn btn-success"><i class="glyphicon glyphicon-ok"></i> Aceptar</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modal-personal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="close" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><i class="glyphicon glyphicon-list"></i> Personal</h4>
                    </div>
                    <div class="modal-body">
                        <table class="table table-striped table-bordered table-hover" id="tb-personal" style="width: 100%">
                            <thead>
                            <tr>
                                <th>Nombres y Apellidos</th>
                                <th>Área</th>
                                <th>Cargo</th>
                                <th>Seleccione</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                        <button role="submit" type="button" class="btn btn-success"><i class="glyphicon glyphicon-ok"></i> Aceptar</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modal-maquinaria">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="close" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><i class="glyphicon glyphicon-list"></i> Maquinaria</h4>
                    </div>
                    <div class="modal-body">
                        <table class="table table-striped table-bordered table-hover" id="tb-maquinaria" style="width: 100%">
                            <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Marca</th>
                                <th>Modelo</th>
                                <th>Serie Chasis</th>
                                <th>Serie Motor</th>
                                <th>Seleccione</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                        <button role="submit" type="button" class="btn btn-success"><i class="glyphicon glyphicon-ok"></i> Aceptar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('plugins/iCheck/icheck.js') }}"></script>
    <script src="{{ asset('plugins/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script>
        var urlListarClientes = '{{ route('clientes.getAll') }}';
        var urlListarMaquinarias = '{{ route('maquinaria.getAll') }}';
        var urlListarPersonal = '{{ route('personal.getAll') }}';
        function validate() {
            if($('#frmRegistro').valid()){
                $('#frmRegistro').get(0).submit();
            }else{
                BootstrapDialog.alert({
                    title: '<i class="glyphicon glyphicon-warning-sign"></i> Advertencia',
                    cssClass: 'modal-warning',
                    message: 'Se ha encontrados datos vacios, complete los datos.'
                })
            }
        }
        $(document).ready(function () {
            selectOption({
                tipo_registro: "{{ old('tipo_registro', isset($registro) ? $registro->tipo_registro : "0") }}",
                estado: "{{ old('estado', isset($registro) ? $registro->estado : "E") }}"
            })
            $('input[name="estado_maquinaria"]').val('{{ old('estado_maquinaria', isset($registro) ? $registro->estado_maquinaria:"O") }}');
        });
    </script>
    <script src="{{ asset('js/registro.js') }}"></script>
@endsection