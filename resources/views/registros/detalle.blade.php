@extends('layouts.app')
@section('headStyles')
    <style>
        .content-collapse{
            padding-top: 15px;
            box-sizing: border-box;
        }
    </style>
@endsection
@section('content')
    <div class="container">
        <ul class="list-group">
            <li class="list-group-item"><a href="#div1" aria-expanded="true" class="collapsed" data-toggle="collapse"><i class="glyphicon glyphicon-save"></i> Registro</a>
                <div id="div1" aria-expanded="true" class="content-collapse collapse in">
                    <div class="row">
                        <div class="col-xs-4">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">Registro N°</span>
                                    <input readonly type="text" name="id_registro" id="id_registro" class="form-control" value="{{ $registro->id_registro }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">Fecha Emisión</span>
                                    <input readonly class="form-control" value="{{ substr($registro->fecha_emision, 0, 10) }}" type="text" id="fecha_emision" name="fecha_emision">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            @if($registro->estado!='T')
                                <div class="btn-group">
                                    <button data-toggle="modal" data-target="#modal-material" type="button" class="btn btn-info"><i class="glyphicon glyphicon-plus"></i> Agregar Material</button>
                                    <button data-toggle="modal" data-target="#modal-detalle" type="button" class="btn btn-warning"><i class="glyphicon glyphicon-plus"></i> Agregar Detalle</button>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </li>
            <li class="list-group-item"><a href="#div2" data-toggle="collapse"><i class="glyphicon glyphicon-barcode"></i> Materiales</a>
                <div id="div2" class="content-collapse collapse" aria-expanded="false" style="height: 0px;">
                    <table class="table table-striped table-bordered table-hover" id="tb-materiales">
                        <thead>
                        <tr>
                            <th style="width: 20%">Tipo</th>
                            <th style="width: 30%">Descripción</th>
                            <th style="width: 10%">Cantidad</th>
                            <th style="width: 10%">Litros</th>
                            <th style="width: 10%">Galones</th>
                            <th style="width: 10%">Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($materiales)>0)
                            @foreach($materiales as $material)
                                <tr>
                                    <td>{{$material->nombre_tipo_material}}</td>
                                    <td>{{$material->descripcion}}</td>
                                    <td>{{$material->cantidad}}</td>
                                    <td>{{$material->litros}}</td>
                                    <td>{{$material->galones}}</td>
                                    <td>
                                        <a href="#" class="btn btn-link" data-toggle="tooltip" title="Editar"><i class="glyphicon glyphicon-edit"></i></a>
                                        <a href="#" class="btn btn-link" data-toggle="tooltip" title="Eliminar"><i class="glyphicon glyphicon-remove"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr role="row">
                                <td  colspan="6">No se han encontrado datos</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </li>
            <li class="list-group-item"><a href="#div3" data-toggle="collapse"><i class="glyphicon glyphicon-list"></i> Detalle</a>
                <div id="div3" class="content-collapse collapse" aria-expanded="false" style="height: 0px;">
                    <table class="table table-striped table-bordered table-hover" id="tb-detalle">
                        <thead>
                        <tr>
                            <th style="width: 25%">Personal</th>
                            <th style="width: 35%">Descripción</th>
                            <th style="width: 10%">Horas</th>
                            <th style="width: 10%">Hora Inicio</th>
                            <th style="width: 10%">Hora Termino</th>
                            <th style="width: 10%">Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($detalle)>0)
                            @foreach($detalle as $item)
                                <tr>
                                    <td>{{$item->nombres}} {{ $item->apellidos }}</td>
                                    <td>{{$item->descripcion}}</td>
                                    <td>{{$item->horas}}</td>
                                    <td>{{$item->hora_inicio}}</td>
                                    <td>{{$item->hora_termino}}</td>
                                    <td>
                                        <a href="#" class="btn btn-link" data-toggle="tooltip" title="Editar"><i class="glyphicon glyphicon-edit"></i></a>
                                        <a href="#" class="btn btn-link" data-toggle="tooltip" title="Eliminar"><i class="glyphicon glyphicon-remove"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr role="row">
                                <td  colspan="6">No se han encontrado datos</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="modal fade" id="modal-material">
                <div class="modal-dialog">
                    <form class="modal-content">
                        <div class="modal-header">
                            <button data-dismiss="modal" class="close" type="button">&times;</button>
                            <h4 class="modal-title"><i class="glyphicon glyphicon-save"></i> Registro de material</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-xs-12 col-md-4">
                                    <input type="hidden" name="id_registro_material" id="id_registro_material" value="{{ $registro->id_registro }}">
                                    <div class="form-group">
                                        <label for="tipo_registro" class="control-label" style="width: 100%">Tipo registro</label>
                                        <select min="1" name="tipo_registro" id="tipo_registro" class="form-control" style="width: 100%">

                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-8">
                                    <div class="form-group">
                                        <label for="descripcion" class="control-label" style="width: 100%">Descripción</label>
                                        <input required type="text" class="form-control" name="descripcion" id="descripcion">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-md-4">
                                    <div class="form-group">
                                        <label for="cantidad" class="control-label">Cantidad</label>
                                        <input type="number" class="form-control" name="cantidad" id="cantidad">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-4">
                                    <div class="form-group">
                                        <label for="litros" class="control-label">Litros</label>
                                        <input type="number" class="form-control" name="litros" id="litros">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-4">
                                    <div class="form-group">
                                        <label for="galones" class="control-label">Galones</label>
                                        <input type="number" class="form-control" name="galones" id="galones">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-md-4">
                                    <div class="form-group">
                                        <label for="estado_material" class="control-label" style="width: 100%">Estado</label>
                                        <select name="estado_material" id="estado_material" class="form-control" style="width: 100%">
                                            <option value="1">ACTIVO</option>
                                            <option value="0">INACTIVO</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button data-dismiss="modal" class="btn btn-default pull-left" type="button">Cancelar</button>
                            <button class="btn btn-success" type="button"><i class="glyphicon glyphicon-save"></i> Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-xs-12">
            <div class="modal fade" id="modal-detalle">
                <div class="modal-dialog">
                    <form class="modal-content">
                        <div class="modal-header">
                            <button data-dismiss="modal" class="close" type="button">&times;</button>
                            <h4 class="modal-title"><i class="glyphicon glyphicon-save"></i> Registro de detalle</h4>
                        </div>
                        <div class="modal-body">

                        </div>
                        <div class="modal-footer">
                            <button data-dismiss="modal" class="btn btn-default pull-left" type="button">Cancelar</button>
                            <button class="btn btn-success" type="button"><i class="glyphicon glyphicon-save"></i> Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection