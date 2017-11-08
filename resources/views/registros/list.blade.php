@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="page-header"><i class="glyphicon glyphicon-list"></i> Lista de Registros</h4>
    <div class="row">
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
                    <th style="width: 40%">Cliente</th>
                    <th style="width: 15%">Maquinaria</th>
                    <th style="width: 15%">Tipo</th>
                    <th style="width: 10%">Fecha Emisión</th>
                    <th style="width: 10%">Estado</th>
                    <th style="width: 10%">Acciones</th>
                </tr>
                </thead>
                <tbody>
                @if(count($registros)>0)
                    @foreach($registros as $registro)
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
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