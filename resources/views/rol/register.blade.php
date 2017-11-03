@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            @if(isset($rol))
                                <i class="glyphicon glyphicon-edit"></i> Editar
                            @else
                                <i class="glyphicon glyphicon-plus"></i> Nuevo
                            @endif
                        </h4>
                    </div>
                    <div class="panel-body">
                        <form action="{{ route('roles.store') }}" class="form-horizontal" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" name="id_rol" id="id_rol" value="{{ isset($rol) ? $rol->id_rol : 0 }}">
                            <div class="form-group {{ $errors->has('nombre') ? 'has-error' : '' }}">
                                <label for="nombre" class="control-label col-xs-4">Nombre</label>
                                <div class="col-xs-8">
                                    <input type="text" value="{{ isset($rol) ? $rol->nombre : ''}}" name="nombre" id="nombre" class="form-control" required autofocus />
                                    @if($errors->has('nombre'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('nombre') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('descripcion') ? 'has-error' : '' }}">
                                <label for="descripcion" class="control-label col-xs-4">Descripción</label>
                                <div class="col-xs-8">
                                    <textarea name="descripcion" id="descripcion" cols="30" class="form-control"
                                              rows="3">{{ isset($rol) ? $rol->descripcion : '' }}</textarea>
                                    @if($errors->has('descripcion'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('descripcion') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <a href="{{ request()->headers->get('referer') }}" class="btn btn-link"><i class="glyphicon glyphicon-arrow-left"></i> Atras</a>
                            <button class="btn btn-success pull-right" type="submit"><i class="glyphicon glyphicon-save"></i> Guardar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection