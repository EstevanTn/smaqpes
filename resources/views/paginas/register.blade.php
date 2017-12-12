<?php
$listIcons = [
    'glyphicon glyphicon-star-empty','glyphicon glyphicon-star', 'glyphicon glyphicon-user', 'glyphicon glyphicon-barcode',
  'glyphicon glyphicon-th-list', 'glyphicon glyphicon-list', 'glyphicon glyphicon-list-alt', 'glyphicon glyphicon-edit',
  'glyphicon glyphicon-remove', 'glyphicon glyphicon-pencil', 'glyphicon glyphicon-ok', 'glyphicon glyphicon-plus',
  'glyphicon glyphicon-check', 'glyphicon glyphicon-save', 'glyphicon glyphicon-asterisk','glyphicon glyphicon-pushpin',
  'glyphicon glyphicon-certificate', 'glyphicon glyphicon-cog', 'glyphicon glyphicon-arrow-left',
  'glyphicon glyphicon-arrow-right', 'glyphicon glyphicon-arrow-up', 'glyphicon glyphicon-arrow-down',
];
?>
@extends('layouts.app')

@section('headStyles')

@endsection

@section('content')
    <div class="container">
        <div class="col-xs-12 col-md-8 col-md-offset-2">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="glyphicon glyphicon-plus"></i> Registro de página</h4>
                </div>
                <div class="panel-body">
                    <form id="frm-pagina" method="post" action="{{ isset($pagina) ? route('paginas_rol.update') : route('paginas_rol.store') }}">
                        <div class="row">
                            {{ csrf_field() }}
                            <input type="hidden" name="id_pagina_permiso" id="id_pagina_permiso" value="{{ old('id_pagina_permiso', isset($pagina->id_pagina_permiso) ? $pagina->id_pagina_permiso : '0') }}" />
                            <div class="col-xs-12">
                                <div class="form-group {{ $errors->has('id_rol') ? 'has-error' : '' }}">
                                    <label for="id_rol" class="control-label">Rol</label>
                                    <select name="id_rol" id="id_rol" class="form-control">
                                        <option value="0">-- SELECCIONE --</option>
                                        @foreach($roles as $rol)
                                            <option value="{{ $rol->id_rol }}">{{ $rol->nombre }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('id_rol'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('id_rol')  }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-5">
                                <div class="form-group {{ $errors->has('icono')?'has-error':'' }}">
                                    <label for="icono" class="control-label">Icono</label>
                                    <div class="input-group">
                                        <input list="list-icons" id="icono" name="icono" type="text" class="form-control" value="{{ old('icono', isset($pagina)?$pagina->icono:'') }}">
                                        <datalist id="list-icons">
                                            @foreach($listIcons as $icon)
                                                <option value="{{ $icon }}" />
                                            @endforeach
                                        </datalist>
                                        <span class="input-group-addon">
                                            <i id="icon-preview"></i>
                                        </span>
                                    </div>
                                    @if($errors->has('icono'))
                                        <span class="help-block"><span class="strong">{{$errors->first('icono')}}</span></span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-xs-7">
                                <div class="form-group {{ $errors->has('text')?'has-error':'' }}">
                                    <label for="text" class="control-label">Texto</label>
                                    <input id="text" name="text" type="text" class="form-control" value="{{ old('text', isset($pagina)?$pagina->text:'') }}">
                                    @if($errors->has('text'))
                                        <span class="help-block"><span class="strong">{{ $errors->first('text') }}</span></span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group {{ $errors->has('url')?'has-error':'' }}">
                                    <label for="url" class="control-label">Url</label>
                                    <input type="text" class="form-control" name="url" id="url" value="{{ old('url', isset($pagina)?$pagina->url:'') }}">
                                    @if($errors->has('url'))
                                        <span class="help-block"><strong>{{$errors->first('url')}}</strong></span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="" class="control-label">Página principal</label>
                                    <select name="id_padre" id="id_padre" class="form-control">
                                        <option value="0">-- SELECCIONE --</option>
                                        @foreach($paginas_padre as $padre)
                                            <option value="{{ $padre->id_pagina_permiso }}">{{$padre->text}} ({{ $padre->rol }})</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-4">
                                <div class="form-group">
                                    <label for="estado" class="control-label">Estado</label>
                                    <select name="estado" id="estado" class="form-control">
                                        <option value="1">ACTIVO</option>
                                        <option value="0">INACTIVO</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="panel-footer">
                    <a href="{{ route('paginas_rol') }}" class="btn btn-link"><i class="glyphicon glyphicon-arrow-left"></i> Listado de páginas</a>
                    <button type="button" onclick="document.getElementById('frm-pagina').submit()" class="btn btn-success pull-right"><i class="glyphicon glyphicon-save"></i> Guardar</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
           $('#icono').on('input keyup', function () {
               $('#icon-preview').attr('class', $(this).val());
           });
            @isset($pagina)
                selectOption({
                    id_rol: '{{ $pagina->id_rol }}',
                    id_padre: '{{ $pagina->id_pagina_permiso_padre ? $pagina->id_pagina_permiso_padre : 0 }}',
                    estado: '{{ $pagina->estado }}',
                    icono: '{{ $pagina->icono }}'
                });
            @endisset
        });
    </script>
@endsection