@extends('layouts.app')

@section('headStyles')

@endsection

@section('content')
    <div class="container">
        <div class="col-xs-12">
            @include('partials.messages')
        </div>
        <div class="col-xs-12 col-md-8 col-md-offset-2">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="glyphicon glyphicon-pencil"></i> Registro de horas mantenimiento</h4>
                </div>
                <div class="panel-body">
                    <form method="post" id="frm-horasmantenimiento" action="{{ isset($entity) ? route('horasmantenimiento.update') : route('horasmantenimiento.store') }}" class="form-horizontal">
                        {{ csrf_field() }}
                        <input type="hidden" value="{{ old('id_horas_mantenimiento', isset($entity)?$entity->id_horas_mantenimiento:0) }}" id="id_horas_mantenimiento" name="id_horas_mantenimiento">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="id_maquinaria" class="control-label col-xs-4">Nombre Maquinaria</label>
                                    <div class="col-xs-8">
                                        <select name="id_maquinaria" id="id_maquinaria" class="form-control">
                                            <option value="0">-- SELECCIONE --</option>
                                            @foreach($maquinarias as $maquinaria)
                                                <option value="{{$maquinaria->id_maquinaria}}">{{$maquinaria->nombre}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <label for="" class="coontrol-label col-xs-4">Total horas</label>
                                    <div class="col-xs-8">
                                        <div class="input-group">
                                            <input value="{{ old('total_horas', isset($entity)?$entity->total_horas:'') }}" type="text" name="total_horas" id="total_horas" class="form-control">
                                            <span class="input-group-addon">
                                                <i class="glyphicon glyphicon-time"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <label for="" class="coontrol-label col-xs-4">Estado</label>
                                    <div class="col-xs-8">
                                        <select name="estado" id="estado" class="form-control">
                                            <option value="A">ACTIVO</option>
                                            <option value="I">INACTIVO</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="panel-footer">
                    <a href="{{ route('horasmantenimiento') }}" class="btn btn-link"><i class="glyphicon glyphicon-arrow-left"></i> Atras</a>
                    <div class="btn-group pull-right">
                        <button onclick="document.getElementById('frm-horasmantenimiento').submit()" class="btn btn-success"><i class="glyphicon glyphicon-save"></i> Guardar</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                @isset($entity)
                    <button onclick="clear()" style="margin-bottom: 10px" data-target="#modal-horas-mantenimiento" data-toggle="modal" class="btn btn-default"><i class="glyphicon glyphicon-plus"></i> Agregar detalle</button>
                    {{ $detalle->links() }}
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <th>Material</th>
                        <th>Descripción</th>
                        <th>Cantidad</th>
                        <th>Litros</th>
                        <th>Galones</th>
                        <th>Precio</th>
                        <th>Acciones</th>
                        </thead>
                        <tbody>
                            @if(count($detalle)>0)
                                @foreach($detalle as $item)
                                    <tr>
                                        <td>{{ $item->material }}</td>
                                        <td>{{ $item->descripcion }}</td>
                                        <td class="text-center">{{ $item->cantidad }}</td>
                                        <td>{{ $item->litros }}</td>
                                        <td>{{ $item->galones }}</td>
                                        <td class="text-center">{{ $item->precio }}</td>
                                        <td>
                                            <a title="Editar" data-toggle="tooltip" href="javascript: editar('{{json_encode($item)}}')" class="btn btn-link"><i class="glyphicon glyphicon-edit"></i></a>
                                            <!--<a title="Eliminar" data-toggle="tooltip" href="" class="btn btn-link"><i class="glyphicon glyphicon-remove"></i></a>-->
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="8">No se han encontrado datos</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    {{ $detalle->links() }}
                @endisset
            </div>
        </div>
        <div class="modal fade" id="modal-horas-mantenimiento">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><i class="glyphicon glyphicon-pencil"></i> Registro de detalle</h4>
                    </div>
                    <div class="modal-body">
                        <form >
                            {{ csrf_field() }}
                            <input type="hidden" id="id_detalle_horas_mantenimiento" name="id_detalle_horas_mantenimiento" value="0">
                            <input data-exclude="true" type="hidden" name="id_horas_mantenimiento" value="{{ isset($entity)?$entity->id_horas_mantenimiento:0}}">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label style="display: block" for="" class="control-label">Tipo material</label>
                                        <select style="width: 100%" name="id_tipo_material" id="id_tipo_material" class="form-control">
                                            <option value="0">-- SELECCIONE --</option>
                                            @foreach($tipos_material as $tipo)
                                                <option value="{{ $tipo->id_tipo_material }}">{{ $tipo->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label style="display: block" for="" class="control-label">Material</label>
                                        <select style="width: 100%" name="id_material" id="id_material" class="form-control">
                                            <option value="0">-- SELECCIONE --</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label style="display: block" for="" class="control-label">Proveedor</label>
                                        <select style="width: 100%" name="id_material_proveedor" id="id_material_proveedor" class="form-control">
                                            <option value="0">-- SELECCIONE --</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label for="" class="control-label">Cantidad</label>
                                        <input type="text" class="form-control" id="cantidad" name="cantidad">
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label for="" class="control-label">Litros</label>
                                        <input type="text" class="form-control" id="litros" name="litros">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label for="" class="control-label">Galones</label>
                                        <input type="text" class="form-control" id="galones" name="galones">
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label for="" class="control-label" style="display: block">Estado</label>
                                        <select style="width: 100%" name="estadox" id="estadox" class="form-control">
                                            <option value="1">ACTIVO</option>
                                            <option value="0">INACTICO</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <label for="" class="control-label">Descripción</label>
                                    <textarea class="form-control" name="descripcion" id="descripcion" cols="30" rows="3"></textarea>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button data-dismiss="modal" class="btn btn-default">Cancelar</button>
                        <button id="btn-guardar" class="btn btn-success"><i class="glyphicon glyphicon-save"></i> Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        var urlListarMateriales = '{{ route('materiales.all') }}';
        function clear() {
            $('#id_detalle_horas_mantenimiento').val(0);
        }
        function editar(data) {
            data = JSON.parse(data);
            var option = $('#id_tipo_material')
                .find('option:contains("'+data.tipo_material+'")')
                .first();

            $('#modal-horas-mantenimiento').modal('show');

            $('#id_tipo_material').val(option.val()).trigger('change').triggerHandler('select2:select',{
                fnCallback: function () {

                    $('#id_material').val(data.id_material)
                        .triggerHandler('select2:select', {
                            fnCallback: function () {
                                $('#id_material_proveedor').val(data.id_material_proveedor)
                                    .triggerHandler('select2:select', {
                                        fnCallback: function () {
                                            console.dir(data);
                                            $('[name="id_horas_mantenimiento"]').val(data.id_horas_mantenimiento);
                                            $('#id_detalle_horas_mantenimiento').val(data.id_detalle_horas_mantenimiento);
                                            $('#cantidad').val(data.cantidad);
                                            $('#litros').val(data.litros);
                                            $('#galones').val(data.galones);
                                            $('#descripcion').val(data.descripcion);
                                        }
                                    });
                            }
                        });
                },
            });
        }
    </script>
    <div id="errorAjax"></div>
    <script src="{{ asset('js/material.js') }}"></script>
    <script>
        var urlBase ='{{ url('/') }}';
        $(document).ready(function () {
            @isset($entity)
                selectOption({
                    id_maquinaria: '{{ $entity->id_maquinaria }}',
                    estado: '{{ $entity->estado }}',
                });
                $('#btn-guardar').on('click', function (e) {
                    var id_detalle = parseInt($('#id_detalle_horas_mantenimiento').val());
                    var id_horas = parseInt('{{ $entity->id_horas_mantenimiento }}');
                    var url = '';
                    if(id_detalle==0 || typeof(id_detalle)==='undefined'|| id_detalle=='')
                    {
                        url = urlBase+'/horasmantenimiento/'+id_horas+'/detalle/store';
                    }else{
                        url = urlBase+'/horasmantenimiento/'+id_horas+'/detalle/update';
                    }
                    console.log(url);
                    $.ajax({
                        url: url ,
                        data: {
                            id_detalle_horas_mantenimiento: id_detalle,
                            id_horas_mantenimiento: id_horas,
                            id_material: $('#id_material').val(),
                            id_material_proveedor: $('#id_material_proveedor').val(),
                            cantidad: $('#cantidad').val(),
                            litros: $('#litros').val(),
                            galones: $('#galones').val(),
                            descripcion: $('#descripcion').val(),
                            tipo_material: $('#id_tipo_material option:selected').text(),
                            estado: $('#estadox').val()
                        },
                        success: function (response) {
                            $('#modal-horas-mantenimiento').modal('hide');
                            BootstrapDialog.alert({
                                message: response.message,
                                callback: function () {
                                    location.reload();
                                }
                            })
                        },
                        error: function (xhr) {
                            //$('#errorAjax').html(xhr.responseText);
                        }
                    });
                });

            @endisset
        })
    </script>
@endsection