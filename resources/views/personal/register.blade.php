@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        @if(isset($personal))
                            <i class="glyphicon glyphicon-edit"></i> Editar
                        @else
                            <i class="glyphicon glyphicon-plus"></i> Nuevo
                        @endif
                    </h4>
                </div>
                <div class="panel-body">
                    @include('partials.messages')
                    <form id="frmPersonal" action="{{ route('personal.store') }}" class="form-horizontal" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" value="{{ isset($personal) ? $personal->id_personal : old('id_personal') }}" name="id_personal" id="id_personal">
                        <div class="form-group {{ $errors->has('id_tipo_documento') ? 'has-error' : '' }}">
                            <label for="id_tipo_documento" class="control-label col-xs-4">Tipo Documento</label>
                            <div class="col-xs-8">
                                <select name="id_tipo_documento" id="id_tipo_documento" class="form-control">
                                    <option value="0">-- SELECCIONE --</option>
                                    @isset($tipos_doc)
                                        @foreach($tipos_doc as $tipo)
                                            <option {{ (int)old('id_tipo_documento') == $tipo->id_tipo_documento ? 'selected' : '' }} data-len="{{ $tipo->valor }}" value="{{ $tipo->id_tipo_documento }}">{{ $tipo->nombre }} ({{ trim($tipo->siglas) }})</option>
                                        @endforeach
                                    @endisset
                                </select>
                                @if($errors->has('id_tipo_documento'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('id_tipo_documento') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('numero_documento') ? 'has-error' : '' }}">
                            <label for="numero_documento" class="control-label col-xs-4">Número Documento</label>
                            <div class="col-xs-8">
                                <input type="text" class="form-control" name="numero_documento" id="numero_documento" value="{{ isset($personal) ? $personal->numero_documento : old('numero_documento') }}" />
                                @if($errors->has('numero_documento'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('numero_documento') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('nombres') ? 'has-error' : '' }}">
                            <label for="nombres" class="control-label col-xs-4">Nombres</label>
                            <div class="col-xs-8">
                                <input type="text" class="form-control" name="nombres" id="nombres" value="{{ isset($personal) ? $personal->nombres : old('nombres') }}" />
                                @if($errors->has('nombres'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nombres') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('apellidos') ? 'has-error' : '' }}">
                            <label for="apellidos" class="control-label col-xs-4">Apellidos</label>
                            <div class="col-xs-8">
                                <input type="text" class="form-control" name="apellidos" id="apellidos" value="{{ isset($personal) ? $personal->apellidos : old('apellidos') }}" />
                                @if($errors->has('apellidos'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('apellidos') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('direccion') ? 'has-error' : '' }}">
                            <label for="direccion" class="control-label col-xs-4">Dirección</label>
                            <div class="col-xs-8">
                                <input type="text" class="form-control" name="direccion" id="direccion" value="{{ isset($personal) ? $personal->direccion : old('direccion') }}" />
                                @if($errors->has('direccion'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('direccion') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                            <label for="email" class="control-label col-xs-4">E-Mail</label>
                            <div class="col-xs-8">
                                <input type="email" class="form-control" name="email" id="email" value="{{ isset($personal) ? $personal->email : old('email') }}" />
                                @if($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('fecha_nacimiento') ? 'has-error' : '' }}">
                            <label for="fecha_nacimiento" class="control-label col-xs-4">Fecha Nacimiento</label>
                            <div class="col-xs-8">
                                <input placeholder="dd/mm/yyyy" type="text" class="form-control" name="fecha_nacimiento" id="fecha_nacimiento" value="{{ isset($personal) ? $personal->fecha_nacimiento : old('fecha_nacimiento') }}" />
                                @if($errors->has('fecha_nacimiento'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('fecha_nacimiento') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('id_area') ? 'has-error' : '' }}">
                            <label for="id_area" class="control-label col-xs-4">Área</label>
                            <div class="col-xs-8">
                                <select name="id_area" id="id_area" class="form-control">
                                    <option value="0">-- SELECCIONE --</option>
                                    @isset($areas)
                                        @foreach($areas as $area)
                                            <option {{ (int)old('id_area') == $area->id_area ? 'selected' : '' }} data-parent="{{ $area->id_area_padre }}" value="{{ $area->id_area }}">{{ $area->id_area_padre == null ? '' :'-- '  }}{{ $area->nombre }}</option>
                                        @endforeach
                                    @endisset
                                </select>
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('cargo') ? 'has-error' : '' }}">
                            <label for="cargo" class="control-label col-xs-4">Cargo</label>
                            <div class="col-xs-8">
                                <input type="text" class="form-control" value="{{ isset($personal) ? $personal->cargo : old('cargo') }}" name="cargo" id="cargo" />
                                @if($errors->has('cargo'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('cargo') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('sueldo') ? 'has-error' : '' }}">
                            <label for="sueldo" class="control-label col-xs-4">Sueldo</label>
                            <div class="col-xs-8">
                                <input type="number" class="form-control" name="sueldo" id="sueldo" value="{{ isset($personal) ? $personal->sueldo_base : old('sueldo') }}" />
                                @if($errors->has('sueldo'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('sueldo') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('fecha_contrato') ? 'has-error' : '' }}">
                            <label for="fecha_contrato" class="control-label col-xs-4">Fecha Contrato</label>
                            <div class="col-xs-8">
                                <input placeholder="dd/mm/yyyy" type="text" class="form-control" name="fecha_contrato" id="fecha_contrato" value="{{ isset($personal) ? $personal->fecha_contrato : old('fecha_contrato') }}" />
                                @if($errors->has('fecha_contrato'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('fecha_contrato') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('fecha_ingreso') ? 'has-error' : '' }}">
                            <label for="fecha_ingreso" class="control-label col-xs-4">Fecha Ingreso</label>
                            <div class="col-xs-8">
                                <input placeholder="dd/mm/yyyy" type="text" class="form-control" name="fecha_ingreso" id="fecha_ingreso" value="{{ isset($personal) ? $personal->fecha_ingreso : old('fecha_ingreso') }}" />
                                @if($errors->has('fecha_ingreso'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('fecha_ingreso') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('estado') ? 'has-error' : '' }}">
                            <label for="estado" class="control-label col-xs-4">Estado</label>
                            <div class="col-xs-8">
                                <select name="estado" id="estado" class="form-control">
                                    <option {{ old('estado') == "A"? 'selected' : '' }} value="A">ACTIVO</option>
                                    <option {{ old('estado') == "I"? 'selected' : '' }} value="I">INACTIVO</option>
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
                    <a href="{{ route('personal') }}" class="btn btn-link"><i class="glyphicon glyphicon-arrow-left"></i> Atras</a>
                    <button class="btn btn-success pull-right" type="button" onclick="document.getElementById('frmPersonal').submit()"><i class=" glyphicon glyphicon-save"></i> Guardar</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            $('#id_tipo_documento').on('change', function () {
                var optionSeleted = $(this).find('option:selected');
                var data = optionSeleted.data();
                $('#numero_documento').attr('maxlength', data.len);
            });
            @isset($personal)
                selectOption({
                    estado : '{{ $personal->estado }}',
                    id_tipo_documento: '{{ $personal->id_tipo_documento }}',
                    id_area: '{{ $personal->id_area }}'
                });
            @endisset
        });
    </script>
@endsection