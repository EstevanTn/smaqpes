@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        @if(isset($area))
                            <i class="glyphicon glyphicon-edit"></i> Editar
                        @else
                            <i class="glyphicon glyphicon-plus"></i> Nueva
                        @endif
                    </h4>
                </div>
                <div class="panel-body">
                    <form action="{{ route('areas.store') }}" method="post" class="form-horizontal" id="frmArea">
                        {{ csrf_field() }}
                        <input type="hidden" value="{{ isset($area) ? $area->id_area : 0 }}" name="id_area" id="id_area">
                        <div class="form-group {{ $errors->has('nombre') ? 'has-error' : '' }}">
                            <label for="nombre" class="control-label col-xs-4">Nombre</label>
                            <div class="col-xs-8">
                                <input maxlength="50" type="text" class="form-control" name="nombre" id="nombre" value="{{ isset($area) ? $area->nombre : '' }}" />
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
                                <textarea  class="form-control" name="descripcion" id="descripcion" cols="30" rows="3">{{ isset($area) ? $area->descripcion : '' }}</textarea>
                                @if($errors->has('descripcion'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('descripcion') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('id_area_padre') ? 'has-error' : '' }}">
                            <label for="id_area_padre" class="control-label col-xs-4">Área Padre</label>
                            <div class="col-xs-8">
                                <select name="id_area_padre" id="id_area_padre" class="form-control">
                                    <option value="0">-- SELECCIONE --</option>
                                    @foreach($areas as $a)
                                        <option value="{{ $a->id_area }}">{{ $a->nombre }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('id_area_padre'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('id_area_padre') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('estado') ? 'has-error' : '' }}">
                            <label for="id_area_padre" class="control-label col-xs-4">Estado</label>
                            <div class="col-xs-8">
                                <select name="estado" id="estado" class="form-control">
                                    <option value="1"> ACTIVO</option>
                                    <option value="0"> INACTIVO</option>
                                </select>
                                @if($errors->has('estado'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('estado') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
                <div class="panel-footer">
                    <a href="{{ request()->headers->get('referer') }}" class="btn btn-link" type="button"><i class="glyphicon glyphicon-arrow-left"></i> Atras</a>
                    <button onclick="document.getElementById('frmArea').submit()" class="btn btn-success pull-right" type="button"><i class="glyphicon glyphicon-save"></i> Guardar</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
           @isset($area)
                selectOption('#estado', '{{ $area->estado }}');
                selectOption('#id_area_padre', '{{ $area->id_area_padre=='' ? 0 : $area->id_area_padre   }}')
           @endisset
        });
    </script>
@endsection