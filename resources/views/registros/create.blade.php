@extends('layouts.app')

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
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group">
                                <label for="id_cliente" class="control-label col-xs-4 col-sm-2">Cliente</label>
                                <div class="col-xs-3 col-sm-2">
                                    <input required readonly type="text" class="form-control" name="id_cliente" id="id_cliente">
                                </div>
                                <div class="col-xs-5 col-sm-8">
                                    <div class="input-group">
                                        <input required type="text" class="form-control" name="nombre_cliente" id="nombre_cliente">
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-default"><i class="glyphicon glyphicon-search"></i></button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label for="id_maquinaria" class="control-label col-xs-4">Maquinaria</label>
                                <div class="col-xs-8">
                                    <input type="hidden" class="form-control" name="id_maquinaria" id="id_maquinaria" />
                                    <div class="input-group">
                                        <input required type="text" class="form-control" name="nombre_maquinaria" id="nombre_maquinaria" />
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-default"><i class="glyphicon glyphicon-search"></i></button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label for="tipo_registro" class="control-label col-xs-4">Tipo Mantenimiento</label>
                                <div class="col-xs-8">
                                    <select min="1" name="tipo_registro" id="tipo_registro" class="form-control">
                                        <option value="0">-- SELECCIONE --</option>
                                        @foreach($tipos as $key => $tipo)
                                            <option data-index="{{ $key+1 }}" value="{{ $tipo->id_tipo_registro }}">{{ $tipo->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group">
                                <label for="lugar" class="control-label col-xs-4 col-sm-2">Lugar</label>
                                <div class="col-xs-8 col-sm-10">
                                    <input maxlength="350" type="text" class="form-control" id="lugar" name="lugar">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <div class="form-group">
                                <label for="fecha_emision" class="control-label col-xs-4">Fecha Emisión</label>
                                <div class="col-xs-8">
                                    <div class="input-group">
                                        <input required data-toggle="datepicker" type="text" class="form-control" name="fecha_emision" id="fecha_emision">
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-default"><i class="glyphicon glyphicon-calendar"></i></button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <div class="form-group">
                                <label for="total_horas" class="control-label col-xs-4">Total Horas</label>
                                <div class="col-xs-8">
                                    <input required type="text" class="form-control" id="total_horas" name="total_horas">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <div class="form-group">
                                <label for="hora_inicio_mantto" class="control-label col-xs-4">Hora Inicio Mantto</label>
                                <div class="col-xs-8">
                                    <input type="text" class="form-control" name="hora_inicio_mantto" id="hora_inicio_mantto">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <div class="form-group">
                                <label for="hora_termino_mantto" class="control-label col-xs-4">Hora Termino Mantto</label>
                                <div class="col-xs-8">
                                    <input type="text" class="form-control" id="hora_termino_mantto" name="hora_termino_mantto">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <div class="form-group">
                                <label for="hora_salida_viaje" class="control-label col-xs-4">Hora Salida Viaje</label>
                                <div class="col-xs-8">
                                    <input type="text" class="form-control" name="hora_salida_viaje" id="hora_salida_viaje">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <div class="form-group">
                                <label for="hora_llegada_viaje" class="control-label col-xs-4">Hora Llegada Viaje</label>
                                <div class="col-xs-8">
                                    <input type="text" class="form-control" id="hora_llegada_viaje" name="hora_llegada_viaje">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <div class="form-group">
                                <label for="horometro" class="control-label col-xs-4">Horométro</label>
                                <div class="col-xs-8">
                                    <input required type="number" class="form-control" name="horometro" id="horometro">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <div class="form-group">
                                <label for="kilometraje" class="control-label col-xs-4">Kilometraje</label>
                                <div class="col-xs-8">
                                    <input required type="number" class="form-control" id="kilometraje" name="kilometraje">
                                </div>
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
                            <div class="form-group">
                                <label for="lugar_encontrado" class="control-label col-xs-4 col-sm-2">Lugar Encontrado</label>
                                <div class="col-xs-8 col-sm-10">
                                    <input list="default_lugar_encontrado" type="text" class="form-control" name="lugar_encontrado"
                                           id="lugar_encontrado">
                                    <datalist id="default_lugar_encontrado">
                                        <option value="TALLER DEL CLIENTE"></option>
                                    </datalist>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group">
                                <label for="id_operador" class="control-label col-xs-4 col-sm-2">Operador</label>
                                <div class="col-xs-3 col-sm-2">
                                    <input required name="id_operador" id="id_operador" readonly type="text" class="form-control">
                                </div>
                                <div class="col-xs-5 col-sm-8">
                                    <div class="input-group">
                                        <input required name="nombre_operador" id="nombre_operador" type="text" class="form-control">
                                        <span class="input-group-btn">
                                            <button class="btn btn-default" type="button"><i class="glyphicon glyphicon-search"></i></button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group">
                                <label for="id_operador" class="control-label col-xs-4 col-sm-2">Mecanico</label>
                                <div class="col-xs-3 col-sm-2">
                                    <input required name="id_mecanico" id="id_mecanico" readonly type="text" class="form-control">
                                </div>
                                <div class="col-xs-5 col-sm-8">
                                    <div class="input-group">
                                        <input required name="nombre_mecanico" id="nombre_mecanico" type="text" class="form-control">
                                        <span class="input-group-btn">
                                            <button class="btn btn-default" type="button"><i class="glyphicon glyphicon-search"></i></button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group">
                                <label for="id_operador" class="control-label col-xs-4 col-sm-2">Jefe Responsable</label>
                                <div class="col-xs-3 col-sm-2">
                                    <input required name="id_responsable" id="id_responsable" readonly type="text" class="form-control">
                                </div>
                                <div class="col-xs-5 col-sm-8">
                                    <div class="input-group">
                                        <input required name="nombre_responsable" id="nombre_responsable" type="text" class="form-control">
                                        <span class="input-group-btn">
                                            <button class="btn btn-default" type="button"><i class="glyphicon glyphicon-search"></i></button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group">
                                <label for="" class="control-label col-xs-4 col-sm-2">Observacion</label>
                                <div class="col-xs-8 col-sm-10">
                                    <textarea maxlength="500" name="observacion" id="observacion" cols="30" rows="3" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="estado" class="control-label col-xs-4">Estado</label>
                                <div class="col-xs-8">
                                    <select name="estado" id="estado" class="form-control">
                                        <option value="E">EN ESPERA</option>
                                        <option value="I">INICIADO</option>
                                        <option value="T">TERMINADO</option>
                                        <option value="B">BORRADOR</option>
                                    </select>
                                </div>
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
        <div class="modal fade">
            <div class="modal-dialog">
                
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
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
    </script>    
@endsection