@extends('layouts.app')

@section('content')
    <div class="container">
        <h3 class="page-header"><i class="glyphicon glyphicon-list"></i> Listado de Roles</h3>
        @include('partials.messages')
        <div class="row">
            <div class="col-xs-12">
                <div class="btn-group" style="margin-bottom: 10px">
                    <a href="{{ route('roles.crear') }}" class="btn btn-success" type="buton"><i class="glyphicon glyphicon-plus"></i> Agregar</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Acciones</th>
                    </thead>
                    <tbody>
                    @foreach($roles as $rol)
                        <tr>
                            <td style="width: 30%">{{ $rol->nombre }}</td>
                            <td style="width: 60%">{{ $rol->descripcion }}</td>
                            <th style="width: 10%">
                                <a title="Editar" data-toggle="tooltip" href="{{ route('roles.editar',  ['id' => $rol->id_rol]) }}" class="btn btn-link"><i class="glyphicon glyphicon-edit"></i></a>
                                <a title="Eliminar" data-toggle="tooltip" href="javascript: delete_reg('{{ route('roles.eliminar',  ['id' => $rol->id_rol]) }}')" class="btn btn-link"><i class="glyphicon glyphicon-remove"></i></a>
                            </th>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection