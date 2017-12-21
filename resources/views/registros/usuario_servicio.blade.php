@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-xs-12">
            <h4 class="page-header"><i class="glyphicon glyphicon-list"></i> Listado de servicios activos</h4>
        </div>
        <div class="col-xs-12">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Tipo Servicio</th>
                    <th>Maquinaria</th>
                    <th>Lugar</th>
                    <th>Ver</th>
                </tr>
                </thead>
                <tbody>
                    @if(count($servicios)>0)
                        @foreach($servicios as $item)
                            <tr>
                                <td style="width: 7%">{{ $item->id_registro }}</td>
                                <td style="width: 23%">{{ $item->tipo_servicio }}</td>
                                <td style="width: 25%">{{ $item->nombre_maquinaria }}</td>
                                <td style="width: 35%">{{ $item->lugar }}</td>
                                <td style="width: 10%">
                                    <a data-toggle="tooltip" title="Lista de trabajos realizados" href="{{ route('registros.details.usuario', [ 'id_registro'=> $item->id_registro, 'id_personal'=> Auth::user()->id_personal]) }}" class="btn btn-link"><i class="glyphicon glyphicon-list"></i></a>
                                    <a data-toggle="tooltip" title="Agregar trabajo" href="{{route('registros.create.trabajoUsuario', ['id_personal'=>Auth::user()->id_personal, 'id_registro'=>$item->id_registro])}}" class="btn btn-link"><i class="glyphicon glyphicon-plus"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5">No se han encontrado datos</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts')

@endsection