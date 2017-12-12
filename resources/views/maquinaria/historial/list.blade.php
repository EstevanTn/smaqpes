@extends('layouts.app')
@section('headStyles')

@endsection
@section('content')
    <div class="container">
        <div class="col-xs-12">
            <h4 class="page-header"><i class="glyphicon glyphicon-list"></i> HISTORIAL HOROMETRO {{ $maquinaria->nombre }}</h4>
            @include('partials.messages')
            <div class="row">
                <div class="col-xs-12 col-md-4">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h4 class="panel-title"><i class="glyphicon glyphicon-info-sign"></i> Información</h4>
                        </div>
                        <div class="panel-body">
                            <table>
                                <tr>
                                    <td style="width: 55%">NOMBRE: </td>
                                    <td>{{ $maquinaria->nombre }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 55%">MARCA: </td>
                                    <td>{{ $maquinaria->marca }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 55%">MODELO: </td>
                                    <td>{{ $maquinaria->modelo }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 55%">SERIE CHASIS: </td>
                                    <td>{{ $maquinaria->serie_chasis }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 55%">SERIE MOTOR: </td>
                                    <td>{{ $maquinaria->serie_motor }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title"><i class="glyphicon glyphicon-search"></i> Búsqueda</h4>
                        </div>
                        <div class="panel-body">
                            <form action="{{ route('maquinarias.historial.search', ['id_maquinaria' => $maquinaria->id_maquinaria]) }}" method="POST" class="form-horizontal">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <div class="col-xs-6 col-md-5">
                                        <div class="input-group">
                                            <span class="input-group-addon">Fecha Inicio</span>
                                            <input type="text" class="form-control" name="finicio" id="finicio" data-toggle="datepicker">
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-md-5">
                                        <div class="input-group">
                                            <span class="input-group-addon">Fecha Termino</span>
                                            <input type="text" class="form-control" name="ftermino" id="ftermino" data-toggle="datepicker">
                                        </div>
                                    </div>
                                    <div class="col-xs-3 col-md-2">
                                        <button class="btn btn-default"><i class="glyphicon glyphicon-search"></i> Buscar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="panel-footer">
                            <a href="{{ route('maquinarias.historial.create', [ 'id_maquinaria' => $maquinaria->id_maquinaria ]) }}"><i class="glyphicon glyphicon-plus"></i> Agregar historial</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12">
            {{ $historiales->links() }}
        </div>
        <div class="col-xs-12">
            <table class="table table-striped table-bordered table-hover" id="tb-historial">
                <thead>
                    <tr role="row">
                        <th colspan="1" rowspan="2">Fecha</th>
                        <th colspan="1" rowspan="2">Horometro</th>
                        <th colspan="2" rowspan="1">Hora</th>
                        <th colspan="1" rowspan="2">Acciones</th>
                    </tr>
                    <tr role="row">
                        <th rowspan="1">Inicio</th>
                        <th rowspan="1">Termino</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($historiales))
                        @foreach($historiales as $historia)
                            <tr>
                                <td>{{ substr($historia->fecha_trabajo, 0, 10) }}</td>
                                <td>{{ $historia->horometro }}</td>
                                <td>{{ $historia->hora_inicio }}</td>
                                <td>{{ $historia->hora_termino }}</td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <a href="{{ route('maquinarias.historial.edit', [ 'id' => $historia->id_horas_trabajadas_maquinaria ]) }}" class="btn btn-link" data-toggle="tooltip" title="Editar"><i
                                                    class="glyphicon glyphicon-edit"></i></a>
                                        <a href="javascript: delete_reg('{{ route('maquinarias.historial.delete', [ 'id' => $historia->id_horas_trabajadas_maquinaria, 'id_maquinaria'=>$maquinaria->id_maquinaria ]) }}')" class="btn btn-link" data-toggle="tooltip" title="Eliminar"><i
                                                    class="glyphicon glyphicon-remove"></i></a>
                                    </div>
                                </td>
                            </tr>    
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5">No se ha encontrado datos.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <div class="col-xs-12">
            {{ $historiales->links() }}
        </div>
    </div>
@endsection
@section('scripts')

@endsection