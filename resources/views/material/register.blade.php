@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @include('partials.messages')
            @foreach($errors as $error)
                {{ var_dump($error) }}
            @endforeach
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        @if(isset($material))
                            <i class="glyphicon glyphicon-edit"></i> Editar
                        @else
                            <i class="glyphicon glyphicon-plus"></i> Nuevo
                        @endif
                    </h4>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" method="post" action="{{ route('materiales.store') }}" id="frmMaterial">
                        {{ csrf_field() }}
                        <input type="hidden" name="id_material" id="id_material" value="{{ isset($material) ? $material->id_material : old('id_material') }}">
                        <div class="form-group {{ $errors->has('tipo_material') ? 'has-error' : '' }}">
                            <label for="tipo_material" class="control-label col-xs-4">Tipo Material</label>
                            <div class="col-xs-8">
                                <select autofocus id="tipo_material" name="tipo_material" class="form-control">
                                    <option value="0">-- SELECCIONE --</option>
                                    @foreach($tipos as $tipo)
                                        <option value="{{ $tipo->id_tipo_material }}">{{ $tipo->nombre }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('tipo_material'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tipo_material') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('nombre') ? 'has-error' : '' }}">
                            <label for="nombre" class="control-label col-xs-4">Nombre</label>
                            <div class="col-xs-8">
                                <input maxlength="70" type="text" class="form-control" name="nombre" id="nombre" value="{{ isset($material) ? $material->nombre : old('nombre') }}" />
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
                                <textarea maxlength="250" class="form-control" name="descripcion" id="descripcion" cols="30" rows="3">{{ isset($material) ? $material->descripcion : old('descripcion') }}</textarea>
                                @if($errors->has('descripcion'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('descripcion') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('codigo_interno') ? 'has-error' : '' }}">
                            <label for="codigo_interno" class="control-label col-xs-4">Código Interno</label>
                            <div class="col-xs-8">
                                <input value="{{ isset($material) ? $material->codigo_interno : old('codigo_interno') }}" maxlength="20" type="text" class="form-control" name="codigo_interno" id="codigo_interno" />
                                @if($errors->has('codigo_interno'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('codigo_interno') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('estado') ? 'has-error' : '' }}">
                            <label for="estado" class="control-label col-xs-4">Estado</label>
                            <div class="col-xs-8">
                                <select name="estado" id="estado" class="form-control">
                                    <option value="A">DISPONIBLE</option>
                                    <option value="I">NO DISPONIBLE</option>
                                    <option value="X">AGOTADO</option>
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
                    <a href="{{ route('materiales') }}" class="btn btn-link"><i class="glyphicon glyphicon-arrow-left"></i> Atras</a>
                    <button onclick="document.getElementById('frmMaterial').submit()" class="btn btn-success pull-right"><i class="glyphicon glyphicon-save"></i> Guardar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @include('material.proveedores')
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script>
        @if(isset($material))
            var material = {
                save: function () {
                    if($('#frmProveedor').valid()){
                        document.getElementById('frmProveedor').submit();
                    }
                },
                get: function (id, codigo, nombre, descripcion, precio) {
                    $('#id_proveedor').val(id);
                    $('#codigo_proveedor').val(codigo);
                    $('#nombre_proveedor').val(nombre);
                    $('#descripcion_proveedor').val(descripcion);
                    $('#precio_proveedor').val(precio);
                    $('#modal-proveedor').modal('show');
                }
            };
        @endif
        $(document).ready(function () {

            @if(isset($material))
            selectOption({
                estado: '{{ $material->estado }}',
                tipo_material: '{{ $material->id_tipo_material }}'
            });
            @else
            selectOption({
                estado: '{{ old('estado', 'A') }}',
                tipo_material: '{{ old('tipo_material', 0) }}'
            })
            @endif
        });
    </script>
@endsection