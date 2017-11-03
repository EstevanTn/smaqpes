@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="page-header"><i class="glyphicon glyphicon-list"></i> Lista de usuarios</h3>
    @include('partials.messages')
    <div class="btn-group" style="margin-bottom: 10px">
        <a href="{{ route('usuarios.create') }}" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Agregar</a>
    </div>
    <table class="table table-striped table-bordered table-hover">
        <thead>
        <th style="width: 15%">Usuario</th>
        <th style="width: 25%">Email</th>
        <th style="width: 40%">Nombre y Apellidos</th>
        <th style="width: 10%">Estado</th>
        <th style="width: 10%">Acciones</th>
        </thead>
        <tbody>
            @foreach($usuarios as $usuario)
                <tr>
                    <td>{{ $usuario->name }}</td>
                    <td>{{ $usuario->email }}</td>
                    <td>{{ $usuario->nombres.' '.$usuario->apellidos }}</td>
                    <td>{{ $usuario->estado }}</td>
                    <td>
                        <a href="{{ route('usuarios.edit',['id'=>$usuario->id]) }}" class="btn btn-link"><i class="glyphicon glyphicon-edit"></i></a>
                        <a href="javascript: delete_reg('{{ route('usuarios.delete',['id'=>$usuario->id]) }}')" class="btn btn-link"><i class="glyphicon glyphicon-remove"></i></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $usuarios->links() }}
</div>
@endsection