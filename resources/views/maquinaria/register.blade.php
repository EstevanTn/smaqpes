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
                    <form id="frmMaquinaria" action="{{ route('maquinarias.store') }}" method="post" class="form-horizontal">
                        {{ csrf_field() }}
                        <input type="hidden" name="id_maquinaria" id="id_maquinaria" value="{{ isset($maquinaria) ? $maquinaria->id_maquinaria : old('id_maquinaria') }}">
                        <div class="form-group {{ $errors->has('fecha_adquisicion') ? 'has-error' : '' }}">
                            <label for="fecha_adquisicion" class="control-label col-xs-4">Fecha Adquisición</label>
                            <div class="col-xs-8">
                                <input data-toggle="datepicker" maxlength="10" class="form-control" type="text" name="fecha_adquisicion" id="fecha_adquisicion" value="{{ isset($maquinaria) ? $maquinaria->fecha_adquisicion : old('fecha_adquisicion') }}">
                                @if($errors->has('fecha_adquisicion'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('fecha_adquisicion') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('tipo_maquinaria') ? 'has-error' : '' }}">
                            <label for="tipo_maquinaria" class="control-label col-xs-4">Tipo Maquinaria</label>
                            <div class="col-xs-8">
                                <select name="tipo_maquinaria" id="tipo_maquinaria" class="form-control">
                                    <option value="0">-- SELECCIONE --</option>
                                    @foreach($tipos_maquinaria as $tipo)
                                        <option value="{{ $tipo->id_tipo_maquinaria }}">{{ $tipo->nombre }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('tipo_maquinaria'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tipo_maquinaria') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('nombre') ? 'has-error' : '' }}">
                            <label for="nombre" class="control-label col-xs-4">Nombre</label>
                            <div class="col-xs-8">
                                <input maxlength="200" type="text" class="form-control" id="nombre" name="nombre" value="{{ isset($maquinaria) ? $maquinaria->nombre : old('nombre') }}" />
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
                                <input maxlength="50" class="form-control" type="text" name="marca" id="marca" value="{{ isset($maquinaria) ? $maquinaria->marca : old('marca') }}">
                                @if($errors->has('marca'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('marca') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('modelo') ? 'has-error' : '' }}">
                            <label for="modelo" class="control-label col-xs-4">Modelo</label>
                            <div class="col-xs-8">
                                <input maxlength="20" class="form-control" type="text" name="modelo" id="modelo" value="{{ isset($maquinaria) ? $maquinaria->modelo : old('modelo') }}">
                                @if($errors->has('modelo'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('modelo') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('serie_chasis') ? 'has-error' : '' }}">
                            <label for="serie_chasis" class="control-label col-xs-4">Serie Chasis</label>
                            <div class="col-xs-8">
                                <input maxlength="20" class="form-control" type="text" name="serie_chasis" id="serie_chasis" value="{{ isset($maquinaria) ? $maquinaria->serie_chasis : old('serie_chasis') }}">
                                @if($errors->has('serie_chasis'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('serie_chasis') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('serie_motor') ? 'has-error' : '' }}">
                            <label for="serie_motor" class="control-label col-xs-4">Serie Motor</label>
                            <div class="col-xs-8">
                                <input maxlength="20" class="form-control" type="text" name="serie_motor" id="serie_motor" value="{{ isset($maquinaria) ? $maquinaria->serie_motor : old('serie_motor') }}">
                                @if($errors->has('serie_motor'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('serie_motor') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="imagen" class="control-label col-xs-4">Imagen</label>
                            <div class="col-xs-8">
                                <div class="input-group">
                                    <input list="listimagen" maxlength="300" class="form-control" type="text" name="imagen" id="imagen" value="{{ isset($maquinaria) ? $maquinaria->imagen : old('imagen') }}">
                                    <datalist id="listimagen">
                                        <?php $list = listar_archivos('./photos/') ?>
                                        @foreach($list as $file)
                                            <option value="{{ asset('photos/'.$file) }}" />
                                        @endforeach
                                    </datalist>
                                    <span class="input-group-btn">
                                        <button id="btn-imagen" type="button" class="btn btn-default"><i class="glyphicon glyphicon-ok"></i></button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label col-xs-4">Estado</label>
                            <div class="col-xs-8">
                                <select name="estado" id="estado" class="form-control">
<<<<<<< HEAD
                                    <option value="1">ACTIVO</option>
                                    <option value="0">INACTIVO</option>
=======
                                    <option value="A">ACTIVO</option>
                                    <option value="I">INACTIVO</option>
>>>>>>> be4ed19bbb18c1e0e3d7492ab7911671e8032de8
                                </select>
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

@section('scripts')
    <script>
        $(document).ready(function (e) {
            @isset($maquinaria)
                selectOption({
                    tipo_maquinaria: '{{ $maquinaria->id_tipo_maquinaria }}',
                    estado: '{{ $maquinaria->estado }}'
                });
            @endif
            $('#tipo_maquinaria').on('change', function (e) {
                if(parseInt($(this).val())>0){
                    $.ajax({
                        url: '{{ route('backmaquinaria.getnombre') }}',
                        data: {
                            id: $(this).val()
                        },
                        success: function (response) {
                            $('#nombre').val(response.nombre);
                        }
                    });
                }
            });
            $('#btn-imagen').on('click', function () {
                var src = $('#imagen').val();
                if(src){
                    BootstrapDialog.alert({
                        title: '<i class="glyphicon glyphicon-eye-open"></i> Vista previa',
                        message: '<div class="text-center"><img class="img-responsive img-thumbnail" src="'+src+'" alt="La imagen no se ha encontrado" /></div>',

                    });
                }
            })
        });
    </script>
@endsection