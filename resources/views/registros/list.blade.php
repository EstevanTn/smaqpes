@extends('layouts.app')
<?php
function GetEstado($char){
    if ($char=="E"){
        return "EN ESPERA";
    }elseif ($char=="I"){
        return "INICIADO";
    }elseif ($char=="T"){
        return "TERMINADO";
    }elseif ($char=="B"){
        return "BORRADOR";
    }else{
        return "";
    }
}
?>
@section('content')
<div class="container">
    <h4 class="page-header"><i class="glyphicon glyphicon-list"></i> Lista de Registros</h4>
    <div class="row">
        <div class="col-xs-12">
            @include('partials.messages')
        </div>
        <div class="col-xs-12">
            <div class="btn-group" style="margin-bottom: 15px;">
                <a href="{{ route('registros.create') }}" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Agregar</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            {{ $registros->links() }}
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                <tr>
                    <th style="width: 35%">Cliente</th>
                    <th style="width: 15%">Maquinaria</th>
                    <th style="width: 15%">Tipo</th>
                    <th style="width: 10%">Fecha Emisión</th>
                    <th style="width: 10%">Estado</th>
                    <th style="width: 15%">Acciones</th>
                </tr>
                </thead>
                <tbody>
                @if(count($registros)>0)
                    @foreach($registros as $registro)
                        <tr>
                            <td>{{ $registro->nombre_cliente }}</td>
                            <td>{{ $registro->nombre_maquinaria }}</td>
                            <td>{{ $registro->nombre_tipo }}</td>
                            <td>{{ substr($registro->fecha_emision,0, 10) }}</td>
                            <td>{{ getEstado($registro->estado) }}</td>
                            <td>
                                <a href="{{ route('registros.edit', ['id'=>$registro->id_registro]) }}" class="btn btn-link"><i class="glyphicon glyphicon-edit"></i></a>
                                <a data-toggle="tooltip" title="Eliminar" href="javascript: delete_reg('{{ route('registros.delete', [ 'id' => $registro->id_registro ]) }}')" class="btn btn-link"><i class="glyphicon glyphicon-remove"></i></a>
                                <a data-toggle="tooltip" title="Detalle" href="{{ route('registros.detalle', ['id'=>$registro->id_registro]) }}" class="btn btn-link"><i class="glyphicon glyphicon-th-list"></i></a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr role="row">
                        <td colspan="6">No se han encontrado datos.</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            {{ $registros->links() }}
        </div>
    </div>
</div>
@endsection