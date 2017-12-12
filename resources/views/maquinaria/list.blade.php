@extends('layouts.app')

@section('content')
    <div class="container">
        <h4 class="page-header"><i class="glyphicon glyphicon-list"></i> Lista de Maquinarias</h4>
        @include('partials.messages')
        <div class="row">
            <div class="col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"><i class="glyphicon glyphicon-search"></i> Búsqueda</h4>
                    </div>
                    <div class="panel-body">
                        <form action="{{ route('maquinarias.search') }}" method="post" class="form-horizontal">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-xs-12 col-md-3">
                                    <div class="input-group">
                                        <span class="input-group-addon">Filtro</span>
                                        <select name="filter" id="filter" class="form-control">
                                            <option value="nombre">Nombre</option>
                                            <option value="marca">Marca</option>
                                            <option value="modelo">Modelo</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">Valor</span>
                                        <input type="text" class="form-control" id="q" name="q" />
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-3">
                                    <button class="btn btn-default"><i class="glyphicon glyphicon-search"></i> Buscar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div style="margin-bottom: 15px" class="btn-group">
                    <a href="{{ route('maquinarias.create') }}" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Agregar</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                {{ $maquinarias->links() }}
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr role="row">
                        <th style="width: 25%" class="text-center" rowspan="2">Nombre</th>
                        <th style="width: 12%" class="text-center" rowspan="2">Marca</th>
                        <th style="width: 15%" class="text-center" rowspan="2">Modelo</th>
                        <th style="width: 20%"class="text-center" rowspan="1" colspan="2">Serie</th>
                        <th style="width: 5%" class="text-center" rowspan="2">Año Fab.</th>
                        <th  style="width: 10%" class="text-center" rowspan="2">Fecha Adq.</th>
                        <th rowspan="2" style="width: 13%">Acciones</th>
                    </tr>
                    <tr role="row">
                        <th class="text-center" colspan="1">Chasis</th>
                        <th class="text-center" colspan="1">Motor</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(isset($maquinarias) && count($maquinarias)>0)
                        @foreach($maquinarias as $maquinaria)
                            <tr>
                                <td>{{ $maquinaria->nombre }}</td>
                                <td>{{ $maquinaria->marca }}</td>
                                <td>{{ $maquinaria->modelo }}</td>
                                <td>{{ $maquinaria->serie_chasis }}</td>
                                <td>{{ $maquinaria->serie_motor }}</td>
                                <td class="text-center">{{ $maquinaria->anio_fabricacion }}</td>
                                <td class="text-center">{{ $maquinaria->fecha_adquisicion }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a data-toggle="tooltip" title="Editar" href="{{ route('maquinarias.edit', [ 'id' => $maquinaria->id_maquinaria ]) }}" class="btn btn-link"><i class="glyphicon glyphicon-edit"></i></a>
                                        <a data-toggle="tooltip" title="Eliminar" href="javascript: delete_reg('{{ route('maquinarias.delete', [ 'id' => $maquinaria->id_maquinaria ]) }}')" class="btn btn-link"><i class="glyphicon glyphicon-remove"></i></a>
                                        <a data-toggle="tooltip" title="Ver hostorial de trabajo" href="{{ route('maquinarias.historial', ['id_maquinaria'=>$maquinaria->id_maquinaria]) }}" class="btn btn-link"><i class="glyphicon glyphicon-list"></i></a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="8">No se han encontrado datos.</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                {{ $maquinarias->links() }}
            </div>
        </div>
    </div>
@endsection