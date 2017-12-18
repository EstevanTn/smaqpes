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
                        <input type="hidden" id="id_detalle_registro" name="id_detalle_registro" value="{{ old('id_detalle_registro', isset($material) ? $material->id_detalle_registro : 0) }}">
                        <input type="hidden" id="tipo_material" name="tipo_material" value="{{ old('tipo_material') }}">
                        <div class="form-group {{ $errors->has('id_tipo_material')?'has-error':'' }}">
                            <label for="id_tipo_material" class="control-label col-xs-3">Tipo Material</label>
                            <div class="col-xs-9">
                                <select name="id_tipo_material" id="id_tipo_material" class="form-control">
                                    <option value="0">-- SELECCIONE --</option>
                                    @foreach($tipos_material as $tipo)
                                        <option data-text="{{ $tipo->nombre }}" value="{{ $tipo->id_tipo_material }}">{{ $tipo->nombre }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('id_tipo_material'))
                                    <span class="help-block"><strong>{{ $errors->first('id_tipo_material') }}</strong></span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('id_material')?'has-error':'' }}">
                            <label for="id_material" class="control-label col-xs-3">Material</label>
                            <div class="col-xs-9">
                                <select name="id_material" id="id_material" class="form-control">
                                    <option value="0">-- SELECCIONE --</option>
                                </select>
                                @if($errors->has('id_material'))
                                    <span class="help-block"><strong>{{ $errors->first('id_material') }}</strong></span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('id_material_proveedor')?'has-error':'' }}">
                            <label for="id_material_proveedor" class="control-label col-xs-3">Proveedor</label>
                            <div class="col-xs-9">
                                <select name="id_material_proveedor" id="id_material_proveedor" class="form-control">
                                    <option value="0">-- SELECCIONE --</option>
                                </select>
                                @if($errors->has('id_material_proveedor'))
                                    <span class="help-block"><strong>{{ $errors->first('id_material_proveedor') }}</strong></span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('descripcion')?'has-error':'' }}">
                            <label for="descripcion" class="control-label col-xs-3">Descripción</label>
                            <div class="col-xs-9">
                                <textarea class="form-control" name="descripcion" id="descripcion" cols="30" rows="3">{{ old('descripcion', isset($material)?$material->descripcion:'') }}</textarea>
                                @if($errors->has('descripcion'))
                                    <span class="help-block"><strong>{{ $errors->first('descripcion') }}</strong></span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group {{ $errors->has('cantidad')?'has-error':'' }}">
                                    <label for="cantidad" class="control-label col-xs-3 col-md-6">Cantidad</label>
                                    <div class="col-xs-9 col-md-6">
                                        <input value="{{old('cantidad', isset($material)?$material->cantidad:'')}}" type="number" name="cantidad" id="cantidad" class="form-control">
                                        @if($errors->has('cantidad'))
                                            <span class="help-block"><strong>{{ $errors->first('cantidad') }}</strong></span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group {{ $errors->has('litros')?'has-error':'' }}">
                                    <label for="litros" class="control-label col-xs-3 col-md-6">Litros</label>
                                    <div class="col-xs-9 col-md-6">
                                        <input value="{{old('litros', isset($material)?$material->litros:'')}}" type="number" name="litros" id="litros" class="form-control">
                                        @if($errors->has('litros'))
                                            <span class="help-block"><strong>{{ $errors->first('litros') }}</strong></span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group {{ $errors->has('has-error')?'has-error':'' }}">
                                    <label for="galones" class="control-label col-xs-3 col-md-6">Galones</label>
                                    <div class="col-xs-9 col-md-6">
                                        <input type="number" value="{{old('galones', isset($material)?$material->galones:'')}}" name="galones" id="galones" class="form-control">
                                        @if($errors->has('galones'))
                                            <span class="help-block"><strong>{{ $errors->first('galones') }}</strong></span>
                                        @endif
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
    <script>
        var urlListarMateriales = '{{ route('materiales.all') }}';
    </script>
    <script src="{{ asset('js/material.js') }}"></script>
    <script>
        $(document).ready(function () {
            @isset($material)
                var option = $('#id_tipo_material')
                    .find('option:contains("{{ $material->tipo_material }}")')
                    .first();

                $('#id_tipo_material').val(option.val()).trigger('change').triggerHandler('select2:select',{
                    fnCallback: function () {
                        $('#id_material').val('{{ $material->id_material }}')
                            .triggerHandler('select2:select', {
                                fnCallback: function () {
                                    $('#id_material_proveedor').val('{{$material->id_material_proveedor}}')
                                        .triggerHandler('select2:select', {
                                            fnCallback: function () {
                                                $('#descripcion').val('{{$material->descripcion}}');
                                            }
                                        });
                                }
                            });
                    },
                });
            @endisset
        });
    </script>
@endsection