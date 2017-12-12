@extends('layouts.app')

@section('headStyles')

@endsection

@section('content')
    <div class="container">
        <h3 class="page-header"><i class="glyphicon glyphicon-list"></i> Listado de permisos de páginas</h3>
        <div class="row">
            <div class="col-xs-12">
                @include('partials.messages')
            </div>
            <div class="col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"><i class="glyphicon glyphicon-search"></i> Búsqueda</h4>
                    </div>
                    <div class="panel-body">
                        <form method="POST" class="form-horizontal" action="{{ route('paginas_rol.search') }}">
                            {{ csrf_field() }}
                            <div class="col-xs-4 col-md-3">
                                <div class="input-group">
                                    <span class="input-group-addon">Buscar por</span>
                                    <select name="filtro" id="filtro" class="form-control">
                                        <option value="rol.nombre">Rol</option>
                                        <option value="pagina_permiso.text">Nombre</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-8 col-md-8">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="q" id="q" />
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                                    </span>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="panel-footer">
                        <a href="{{ route('paginas_rol.create') }}" href="btn btn-link"><i class="glyphicon glyphicon-plus"></i> Nuevo permiso</a>
                    </div>
                </div>
            </div>
            <div class="col-xs-12">
                {{ $paginas->links() }}
            </div>
            <div class="col-xs-12">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                    <th style="width: 20%">Texto</th>
                    <th style="width: 45%">Url</th>
                    <th style="width: 5%">Icono</th>
                    <th style="width: 10%">Rol</th>
                    <th style="width: 10%">Estado</th>
                    <th style="width: 10%">Acciones</th>
                    </thead>
                    <tbody>
                    @foreach($paginas as $pagina)
                        <tr>
                            <td>{{ $pagina->text }}</td>
                            <td>{{ trim($pagina->url) !== '' ?  $pagina->url : '#' }}</td>
                            <td class="text-center"><i class="{{ $pagina->icono }}"></i></td>
                            <td>{{ $pagina->rol }}</td>
                            <td>{{ $pagina->estado ? 'ACTIVO' : 'INACTIVO' }}</td>
                            <td>
                                <div class="btn-group">
                                    <a data-toggle="tooltip" title="Editar" href="{{ route('paginas_rol.edit', [ 'id' => $pagina->id_pagina_permiso]) }}" class="btn btn-link"><i class="glyphicon glyphicon-edit"></i></a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-xs-12">
                {{ $paginas->links() }}
            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection