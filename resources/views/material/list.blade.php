<?php
function status($c){
    switch ($c){
        case 'A': return 'DISPONIBLE';
        case 'I': return 'NO DISPONIBLE';
        case 'X': return 'AGOTADO';
    }
}
?>
@extends('layouts.app')
@section('content')
<div class="container">
    <h4 class="page-header"><i class="glyphicon glyphicon-list"></i> Lista de Materiales</h4>
    @include('partials.messages')
    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="glyphicon glyphicon-search"></i> Búsqueda</h4>
                </div>
                <div class="panel-body">
                    <form method="post" action="{{ route('materiales.search') }}">
                        {{ csrf_field() }}
                        <div class="col-xs-12 col-md-3">
                            <div class="input-group">
                                <span class="input-group-addon">Filtro</span>
                                <select style="height: 25px" name="filter" id="filter" class="form-control">
                                    <option value="material.nombre">Nombre</option>
                                    <option value="material.codigo_interno">Cod. Interno</option>
                                    <option value="tipo_material.nombre">Tipo</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon">Valor</span>
                                <input name="q" id="q" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-3">
                            <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i> Buscar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-6">
            <div class="btn-group" style="margin-bottom: 15px;">
                <a href="{{ route('materiales.create') }}" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Agregar</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            {{ $materiales->links() }}
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                <tr>
                    <th style="width: 50%">Nombre</th>
                    <th style="width: 15%;">Código Interno</th>
                    <th style="width: 15%">Tipo</th>
                    <th style="width: 10%">Estado</th>
                    <th style="width: 10%">Acciones</th>
                </tr>
                </thead>
                <tbody>
                @if(count($materiales) > 0)
                    @foreach($materiales as $material)
                        <tr>
                            <td>{{ $material->nombre }}</td>
                            <td>{{ $material->codigo_interno }}</td>
                            <td>{{ $material->tipo }}</td>
                            <td>{{ status($material->estado) }}</td>
                            <td class="text-center">
                                <a class="btn btn-link" title="Editar" href="{{ route('materiales.edit', [ 'id' => $material->id_material ]) }}"><i class="glyphicon glyphicon-edit"></i></a>
                                <a class="btn btn-link" title="Eliminar" href="javascript: delete_reg('{{ route('materiales.delete', [ 'id' => $material->id_material ]) }}')"><i class="glyphicon glyphicon-remove"></i></a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5">No se han encontrado datos.</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            {{ $materiales->links() }}
        </div>
    </div>
</div>
@endsection