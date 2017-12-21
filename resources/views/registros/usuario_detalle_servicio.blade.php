@extends('layouts.app')
@section('headStyles')

@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h4 class="page-header"><i class="glyphicon glyphicon-list-alt"></i> Trabajos realizados en el servicio #{{ $id_registro }}</h4>
            </div>
            <div class="col-xs-12">
                <a href="{{route('registros.create.trabajoUsuario', ['id_registro'=>$id_registro, 'id_personal' => \Illuminate\Support\Facades\Auth::user()->id_personal])}}" class="btn btn-link"><i class="glyphicon glyphicon-plus"></i> Nuevo Trabajo</a>
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Horas</th>
                            <th>Hora Inicio</th>
                            <th>Hora Termino</th>
                            <th>Descripcion</th>
                            <th>Fecha</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tody>
                        @if(count($detalle)>0)
                            @foreach($detalle as $item)
                                <tr>
                                    <td class="text-center" style="width: 10%">{{ $item->horas }}</td>
                                    <td class="text-center" style="width: 10%">{{ substr($item->hora_inicio, 0, 8) }}</td>
                                    <td class="text-center" style="width: 10%">{{ substr($item->hora_termino, 0, 8) }}</td>
                                    <td class="text-left" style="width: 40%;">{{ $item->descripcion }}</td>
                                    <td class="text-center" style="width: 10%">{{ substr($item->fecha, 0, 10) }}</td>
                                    <td class="text-center" style="width: 10%">
                                        <a title="" data-toggle="tooltip" href="{{ route('registros.edit.trabajoUsuario', ['id_registro' => $item->id_registro, 'id_personal'=> $item->id_personal, 'id' => $item->id_horas_trabajadas]) }}" class="btn btn-link"><i class="glyphicon glyphicon-edit"></i></a>
                                        <a title="" data-toggle="tooltip" href="javascript: delete_reg('{{ route('registros.delete.trabajo', ['id_registro' => $item->id_registro, 'id' => $item->id_horas_trabajadas]) }}')" class="btn btn-link"><i class="glyphicon glyphicon-remove"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr><td colspan="6">No se han encontrado datos</td></tr>
                        @endif
                    </tody>
                </table>
            </div>
            <div class="col-xs-12">

            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection