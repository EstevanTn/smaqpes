@extends('layouts.app')

@section('headStyles')
    <link rel="stylesheet" href="{{ asset('plugins/datatables.net-bs/css/dataTables.bootstrap.min.css') }}" />
@endsection

@section('content')
    <div class="container">
        <div class="col-xs-12">
            <h4 class="page-header"><i class="glyphicon glyphicon-list"></i> Configuración de horas mantenimiento</h4>
        </div>
        <div class="col-xs-12" style="margin-bottom: 10px">
            <a href="{{ route('horasmantenimiento.create') }}" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Nuevo</a>
        </div>
        <div class="col-xs-12">
            @include('partials.messages')
        </div>
        <div class="col-xs-12">
            <table id="tb-horas" class="table table-striped table-bordered table-hover">
                <thead>
                <th>Total Horas</th>
                <th>Maquinaria</th>
                <th>Estado</th>
                <th class="text-center">Acciones</th>
                </thead>
                <tbody>
                    @if(count($horas_mantenimiento)>0)
                        @foreach($horas_mantenimiento as $horas)
                            <tr>
                                <td style="width: 10%" class="text-right">{{$horas->total_horas}}</td>
                                <td style="width: 70%">{{ $horas->nombre_maquinaria }}</td>
                                <td style="width: 10%">{{ $horas->estado=='A'? 'ACTIVO':'INACTIVO' }}</td>
                                <td style="width: 10%">
                                    <form method="post" action="{{ route('horasmantenimiento.delete') }}">
                                        {{csrf_field() }}
                                        <a title="Editar" data-toggle="tooltip" href="{{ route('horasmantenimiento.edit',['id'=>$horas->id_horas_mantenimiento]) }}" class="btn btn-link"><i class="glyphicon glyphicon-edit"></i></a>
                                        <input type="hidden" name="id" id="id" value="{{$horas->id_horas_mantenimiento}}">
                                        <button title="Eliminar" data-toggle="tooltip" class="btn btn-link"><i class="glyphicon glyphicon-remove"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="4">No se han encontrado datos</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('plugins/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script>
        $(document).ready(function (e) {
            $('#tb-horas').DataTable();
        })
    </script>
@endsection