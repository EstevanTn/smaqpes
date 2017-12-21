@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-xs-12 col-md-8 col-md-offset-2">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="glyphicon glyphicon-edit"></i> Registro de historial de trabajo</h4>
                </div>
                <div class="panel-body">
                    <form id="frm-trabajo" method="POST" class="form-horizontal" action="{{ route('registros.store.trabajo', [ 'id_registro' => $id_registro ]) }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="id_registro" id="id_registro" value="{{ old('id_registro', $id_registro) }}">
                        <input type="hidden" name="id_horas_trabajadas" id="id_horas_trabajadas" value="{{ old('id_horas_trabajadas', isset($trabajo)?$trabajo->id_horas_trabajadas:'0') }}">
                        <div class="row">
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <label for="" class="control-label col-xs-4">Fecha</label>
                                    <div class="col-xs-8">
                                        <div class="input-group">
                                            <input value="{{old('fecha', isset($trabajo)?$trabajo->fecha:'')}}" data-toggle="datepicker" type="text" class="form-control" id="fecha" name="fecha">
                                            <span class="input-group-addon">
                                                <i class="glyphicon glyphicon-calendar"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <label for="" class="control-label col-xs-4">Horas</label>
                                    <div class="col-xs-8">
                                        <input readonly="readonly" value="{{old('horas', isset($trabajo)?$trabajo->horas:'')}}" type="text" class="form-control" name="horas" id="horas">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <label for="hinicio" class="control-label col-xs-4">Hora Inicio</label>
                                    <div class="col-xs-8">
                                        <div class="input-group">
                                            <input value="{{old('hora_inicio', isset($trabajo)?$trabajo->hora_inicio:'')}}" data-toggle="timepicker" type="text" class="form-control" id="hinicio" name="hinicio">
                                            <span class="input-group-addon">
                                                <i class="glyphicon glyphicon-time"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <label for="" class="control-label col-xs-4">Hora termino</label>
                                    <div class="col-xs-8">
                                        <div class="input-group">
                                            <input value="{{old('hora_termino', isset($trabajo)?$trabajo->hora_termino:'')}}" data-toggle="timepicker" type="text" class="form-control" id="htermino" name="htermino">
                                            <span class="input-group-addon">
                                                <i class="glyphicon glyphicon-time"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="" class="control-label col-xs-2">Personal</label>
                                    <div class="col-xs-10">
                                        <select name="id_personal" id="id_personal" class="form-control">
                                            <option value="0">-- SELECCIONE --</option>
                                            @foreach($personal as $item)
                                                <option value="{{$item->id_personal}}">{{ $item->nombres }} {{ $item->apellidos }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <input type="hidden" name="redirect" id="redirect" value="{{ old('redirect', $redirect) }}">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="" class="control-label col-xs-2">Descripción</label>
                                    <div class="col-xs-10">
                                        <textarea class="form-control" name="descripcion" id="descripcion" cols="30" rows="3">{{ old('descripcion', isset($trabajo)?$trabajo->descripcion:'') }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="panel-footer">
                    <a href="{{ back()->getTargetUrl() }}" class="btn btn-link"><i class="glyphicon glyphicon-arrow-left"></i> Atras</a>
                    <button onclick="document.getElementById('frm-trabajo').submit()" class="btn btn-success pull-right"><i class="glyphicon glyphicon-save"></i> Guardar</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            @if(!empty($selectPersonal))
                selectOption({
                    id_personal: '{{$selectPersonal}}'
                });
            @endif
            @isset($trabajo)
                selectOption({
                    id_personal: '{{$trabajo->id_personal}}'
                });
            @endisset

            $('#hinicio').timepicker().on('hide.timepicker', function (e) {
                $(this).data('time', e.time);
            });

            $('#htermino').timepicker().on('hide.timepicker', function (e) {
                var hinicio = $('#hinicio').data('time');
                var diff = diffTime(hinicio, e.time);
                diff = diff.replace(':','.');
                $('#horas').val(parseFloat(diff).toFixed(2));
            });
        });
    </script>
@endsection