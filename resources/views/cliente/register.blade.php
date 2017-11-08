@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
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
                            <div class="form-group {{ $errors->has('tipo_documento') ? 'has-error' : '' }}">
                                <label for="tipo_documento" class="control-label col-xs-4">Tipo Documento</label>
                                <div class="col-xs-8">
                                    <select name="tipo_documento" id="tipo_documento" class="form-control">
                                        <option value="0">-- SELECCIONE --</option>
                                    </select>
                                    @if($errors->has('tipo_documento'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('tipo_documento') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('nombres') ? 'has-error' : '' }}"></div>
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