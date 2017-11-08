@extends('layouts.app')
@section('content')
    <div class="container">
        <h3 class="page-header"><i class="glyphicon glyphicon-list"></i> Lista de Clientes</h3>
        <div class="row">
            <div class="col-xs-12">
                @include('partials.messages')
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"><i class="glyphicon glyphicon-search"></i> Búsqueda</h4>
                    </div>
                    <div class="panel-body">
                        <form method="post" action="{{ route('clientes.search') }}" class="form-horizontal">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-xs-12 col-sm-4">
                                    <div class="form-group">
                                        <label for="filtro" class="col-xs-4">Buscar por</label>
                                        <div class="col-xs-8">
                                            <div class="radio-inline">
                                                <label for="rbtnrazon_social">
                                                    <input checked class="" type="radio" name="f" id="rbtnrazon_social" value="cliente.razon_social">
                                                    Razon Social
                                                </label>
                                            </div>
                                            <div class="radio-inline">
                                                <label for="rbtnruc">
                                                    <input class="" type="radio" name="f" id="rbtnruc" value="cliente.ruc">
                                                    RUC
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6">
                                    <div class="input-group">
                                        <input required type="text" class="form-control" name="q" id="q">
                                        <span class="input-group-btn">
                                            <button class="btn btn-default"><i class="glyphicon glyphicon-search"></i></button>
                                        </span>
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
                <div class="btn-group">
                    <a href="{{ route('clientes.create') }}" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Agregar</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                {{ $clientes->links() }}
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                        <th style="width: 10%">RUC</th>
                        <th style="width: 35%">Razon Social</th>
                        <th style="width: 25%">Dirección</th>
                        <th style="width: 20%">Representante</th>
                        <th style="width: 10%">Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($clientes)>0)
                        @foreach($clientes as $cliente)
                            <tr>
                                <td class="text-center">{{ $cliente->ruc }}</td>
                                <td>{{ $cliente->razon_social }}</td>
                                <td>{{ empty($cliente->direccion_cliente) ? '-' : $cliente->direccion_cliente }}</td>
                                <td>{{ sprintf('%s %s', $cliente->nombres, $cliente->apellidos) }}</td>
                                <td class="text-center">
                                    <a title="Editar" href="{{ route('clientes.edit', $cliente->id_cliente) }}" class="btn btn-link"><i class="glyphicon glyphicon-edit"></i></a>
                                    <form style="display: inline-block" id="frmDelete" method="post" action="{{ route('clientes.destroy', $cliente->id_cliente) }}">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="_method" id="_method" value="DELETE" />
                                        <button onclick="verificate_delete(event)" class="btn btn-link"><i class="glyphicon glyphicon-remove"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5">No se han encontrados datos.</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                {{ $clientes->links() }}
            </div>
        </div>
    </div>
@endsection