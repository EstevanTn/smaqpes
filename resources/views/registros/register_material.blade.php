@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-xs-12 col-md-8 col-md-offset-2">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="glyphicon glyphicon-edit"></i> Registro de material de servicio</h4>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" id="frm-material" method="post" action="{{ route('registros.store.material', [ 'id_registro' => $id_registro ]) }}">
                        {{ csrf_field() }}
                        <input type="hidden" id="id_registro" name="id_registro" value="{{ $id_registro }}">
                        <div class="form-group">
                            <label for="id_tipo_material" class="control-label col-xs-3">Tipo Material</label>
                            <div class="col-xs-9">
                                <select name="id_tipo_material" id="id_tipo_material" class="form-control">
                                    <option value="0">-- SELECCIONE --</option>
                                    @foreach($tipos_material as $tipo)
                                        <option value="{{ $tipo->id_tipo_material }}">{{ $tipo->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="id_material" class="control-label col-xs-3">Material</label>
                            <div class="col-xs-9">
                                <select name="id_material" id="id_material" class="form-control">
                                    <option value="0">-- SELECCIONE --</option>

                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="id_material_proveedor" class="control-label col-xs-3">Proveedor</label>
                            <div class="col-xs-9">
                                <select name="id_material_proveedor" id="id_material_proveedor" class="form-control">
                                    <option value="0">-- SELECCIONE --</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="descripcion" class="control-label col-xs-3">Descripción</label>
                            <div class="col-xs-9">
                                <input type="text" class="form-control" name="descripcion" id="descripcion">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <label for="cantidad" class="control-label col-xs-3 col-md-6">Cantidad</label>
                                    <div class="col-xs-9 col-md-6">
                                        <input type="number" name="cantidad" id="cantidad" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <label for="cantidad" class="control-label col-xs-3 col-md-6">Litros</label>
                                    <div class="col-xs-9 col-md-6">
                                        <input type="number" name="litros" id="litros" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <label for="galones" class="control-label col-xs-3 col-md-6">Galones</label>
                                    <div class="col-xs-9 col-md-6">
                                        <input type="number" name="galones" id="galones" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <label for="estado" class="control-label col-xs-3 col-md-6">Estado</label>
                                    <div class="col-xs-9 col-md-6">
                                        <select name="estado" id="estado" class="form-control">
                                            <option value="1">ACTIVO</option>
                                            <option value="0">INACTIVO</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="panel-footer">
                    <a href="{{ back()->getTargetUrl() }}" class="btn btn-link"><i class="glyphicon glyphicon-arrow-left"></i> Atras</a>
                    <button onclick="document.getElementById('frm-material').submit()" class="btn btn-success pull-right"><i class="glyphicon glyphicon-save"></i> Guardar</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection