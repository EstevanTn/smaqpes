@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="page-header"><i class="glyphicon glyphicon-list"></i> Lista de Áreas</h3>
    @include('partials.messages')
    <div class="btn-group" style="margin-bottom: 10px">
        <a href="{{ route('areas.create') }}" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Agregar</a>
    </div>
    <ul class="list-group">
        @foreach($areas as $area)
            <li class="list-group-item">
                <div class="row">
                    <a class="btn btn-link" data-target="#collapse-{{ $area->id_area }}" data-toggle="collapse">{{ $area->nombre }}</a>
                    <div class="pull-right">
                        <a href="{{ route('areas.edit', ['id' => $area->id_area]) }}" title="Editar" class="btn btn-link"><i class="glyphicon glyphicon-edit"></i></a>
                        <a href="javascript: delete_reg('{{ route('areas.delete', ['id' => $area->id_area]) }}')" title="Eliminar" class="btn btn-link"><i class="glyphicon glyphicon-remove"></i></a>
                    </div>
                </div>
                <ul class="list-group collapse" id="collapse-{{ $area->id_area }}">
                    @foreach($all_areas as $a)
                        @if($area->id_area==$a->id_area_padre)
                            <li class="list-group-item">
                                {{ $a->nombre }} -> <small>{{ $a->descripcion }}</small>
                                <div class="pull-right">
                                    <a href="{{ route('areas.edit', ['id' => $a->id_area]) }}" title="Editar" class="btn btn-link"><i class="glyphicon glyphicon-edit"></i></a>
                                    <a href="javascript: delete_reg('{{ route('areas.delete', ['id' => $a->id_area]) }}')" title="Eliminar" class="btn btn-link"><i class="glyphicon glyphicon-remove"></i></a>
                                </div>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </li>
        @endforeach
    </ul>
</div>
@endsection