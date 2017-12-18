@extends('layouts.app')

@section('headStyles')

@endsection

@section('content')
    <div class="container">
        <div class="col-xs-12 col-md-8 col-md-offset-2">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="glyphicon glyphicon-pencil"></i> Registro de horas mantenimiento</h4>
                </div>
                <div class="panel-body">
                    <form id="frm-horasmantenimiento" action="{{ isset($entity) ? route('horasmaquinaria.update') : route('horasmantenimiento.store') }}" class="form-horizontal">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <input type="hidden" id="id_maquinaria" name="id_maquinaria" value="{{ old('id_maquinaria', isset($entity)? $entity->id_maquinaria:'') }}">
                                    <label for="nombre_maquinaria" class="control-label col-xs-3">Nombre Maquinaria</label>
                                    <div class="col-xs-9">
                                        <div class="input-group">
                                            <input value="{{ old('nombre_maquinaria', isset($entity)?$entity->nombre_maquinaria:'') }}" type="text" name="nombre_maquinaria" id="nombre_maquinaria" class="form-control">
                                            <span class="input-group-btn">
                                                <button type="button" class="btn btn-default"><i class="glyphicon glyphicon-search"></i></button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <label for="" class="coontrol-label col-xs-4 col-md-3">Total horas</label>
                                    <div class="col-xs-8 col-md-9">
                                        <div class="input-group">
                                            <input type="text" name="total_horas" id="total_horas" class="form-control">
                                            <span class="input-group-addon">
                                                <i class="glyphicon glyphicon-time"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="panel-footer">
                    <a href="{{ back()->getTargetUrl() }}" class="btn btn-link"><i class="glyphicon glyphicon-arrow-left"></i> Atras</a>
                    <button onclick="document.getElementById('frm-horasmantenimiento').submit()" class="btn btn-success pull-right"><i class="glyphicon glyphicon-save"></i> Guardar</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')


@endsection