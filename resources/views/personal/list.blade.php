@extends('layouts.app')
@section('content')
<div class="container">
    <h3 class="page-header"><i class="glyphicon glyphicon-list"></i> Lista de Personal</h3>
    @include('partials.messages')
    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="glyphicon glyphicon-search"></i> Búsqueda</h4>
                </div>
                <div class="panel-body">
                    <form action="{{ route('personal.search') }}" method="post" class="form-horizontal">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-xs-12 col-md-3">
                                <div class="input-group">
                                    <span class="input-group-addon">Filtro</span>
                                    <select name="filter" id="filter" class="form-control">
                                        <option {{ old('filter') == 'nombres' ? 'selected' :'' }} value="nombres">Nombres o Apellidos</option>
                                        <option {{ old('nro_doc') == 'nombres' ? 'selected' :'' }}  value="nro_doc">Número Documento</option>
                                        <option {{ old('cargo') == 'nombres' ? 'selected' :'' }}  value="cargo">Cargo</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <div class="input-group">
                                    <span class="input-group-addon">Valor</span>
                                    <input id="q" name="q" type="text" class="form-control" value="{{ old('q') }}">
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-3">
                                <div class="btn-group" style="margin-bottom:10px">
                                    <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i> Buscar </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="btn-group" style="margin-bottom: 15px;">
                <a href="{{ route('personal.create') }}" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Agregar</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            {{ $personal->links() }}
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                <tr>
                    <th class="text-center" style="width: 10%">Tipo Doc.</th>
                    <th style="width: 12%">Número Doc.</th>
                    <th style="width: 25%">Nombres y Apellidos</th>
                    <th style="width: 15%">Área</th>
                    <th style="width: 18%">Cargo</th>
                    <th style="width: 10%">Sueldo</th>
                    <th style="width: 10%">Acciones</th>
                </tr>
                </thead>
                <tbody>
                @if(count($personal))
                    @foreach($personal as $empleado)
                        <tr>
                            <td class="text-center">{{ $empleado->siglas }}</td>
                            <td>{{ $empleado->numero_documento }}</td>
                            <td>{{ $empleado->nombres.' '.$empleado->apellidos }}</td>
                            <td>{{ $empleado->area }}</td>
                            <td>{{ $empleado->cargo }}</td>
                            <td class="text-right">{{ $empleado->sueldo_base }}</td>
                            <td>
                                <a data-toggle="tooltip" title="Editar" href="{{ route('personal.edit', [ 'id' => $empleado->id_personal ]) }}" class="btn btn-link"><i class="glyphicon glyphicon-edit"></i></a>
                                <a data-toggle="tooltip" title="Eliminar" href="javascript: delete_reg('{{ route('personal.delete', [ 'id' => $empleado->id_personal ]) }}')" class="btn btn-link"><i class="glyphicon glyphicon-remove"></i></a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="7">No se han encontrado datos.</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            {{ $personal->links() }}
        </div>
    </div>
</div>
@endsection