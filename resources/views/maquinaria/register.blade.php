@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        @if(isset($maquinaria))
                            <i class="glyphicon glyphicon-edit"></i> Editar
                        @else
                            <i class="glyphicon glyphicon-plus"></i> Nueva
                        @endif
                    </h3>
                </div>
                <div class="panel-body">
                    <form action="{{ route('maquinarias.store') }}" method="post" class="form-horizontal">
                        {{ csrf_field() }}
                        <input type="hidden" name="id_maquinaria" id="id_maquinaria" value="{{ isset($maquinaria) ? $maquinaria->id_maquinaria : old('id_maquinaria') }}">
                        <div class="form-group {{ $errors->has('nombre') ? 'has-error' : '' }}">
                            <label for="nombre" class="control-label col-xs-4">Nombre</label>
                            <div class="col-xs-8">
                                <input type="text" class="form-control" id="nombre" name="nombre" />
                                @if($errors->has('nombre'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nombre') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('anio') ? 'has-error' : '' }}">
                            <label for="anio" class="control-label col-xs-4">Año Fabricación</label>
                            <div class="col-xs-8">
                                <input name="anio" id="anio" class="form-control" type="number" value="{{ isset($maquinaria) ? $maquinaria->anio_fabricacion : old('anio') }}" />
                                @if($errors->has('anio'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('anio') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('marca') ? 'has-error' : '' }}">
                            <label for="marca" class="control-label col-xs-4">Marca</label>
                            <div class="col-xs-8">
                                <input class="form-control" type="text" name="marca" id="marca" value="{{ isset($maquinaria) ? $maquinaria->marca : old('marca') }}">
                                @if($errors->has('marca'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('marca') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
                <div class="panel-footer">
                    <a class="btn btn-link" href="{{ request()->headers->get('referer') }}"><i class="glyphicon glyphicon-arrow-left"></i> Atras</a>
                    <button onclick="document.getElementById('frmMaquinaria').submit()" type="button" class="btn btn-success pull-right"><i class="glyphicon glyphicon-save"></i> Guardar</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection