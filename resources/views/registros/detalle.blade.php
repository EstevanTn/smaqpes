@extends('layouts.app')
@section('headStyles')
    <style>
        .content-collapse{
            padding-top: 15px;
            box-sizing: border-box;
        }
    </style>
@endsection
@section('content')
    <div class="container">
        <ul class="list-group">
            <li class="list-group-item"><a href="#div1" aria-expanded="true" class="collapsed" data-toggle="collapse"><i class="glyphicon glyphicon-save"></i> Registro</a>
                <div id="div1" aria-expanded="true" class="content-collapse collapse in">
                    <div class="row">
                        <div class="col-xs-12">
                            <table class="table table-responsive">
                                <tr>
                                    <td style="width: 10%"><strong>Servicio N°</strong></td>
                                    <td style="width: 40%">{{ $registro->id_registro }}</td>
                                    <td style="width: 10%"><strong>Total Horas</strong></td>
                                    <td style="width: 40%">{{ $registro->total_horas }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 10%"><strong>Horometro</strong></td>
                                    <td style="width: 40%">{{ $registro->horometro }}</td>
                                    <td style="width: 10%"><strong>Kilometraje</strong></td>
                                    <td style="width: 40%">{{ $registro->kilometraje?$registro->kilometraje:'-' }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 10%"><strong>Fecha</strong></td>
                                    <td style="width: 40%">{{ substr($registro->fecha_emision, 0, 10) }}</td>
                                    <td style="width: 10%"><strong>Tipo Servicio</strong></td>
                                    <td style="width: 40%">{{ \Illuminate\Support\Facades\DB::table('tipo_registro')->where('id_tipo_registro', $registro->id_tipo_registro)->first()->nombre }}</td>
                                </tr>
                            </table>
                            @if($registro->estado!='T')
                                <div class="btn-group">
                                    @if(Auth::user()->id_rol==1)
                                        <a href="{{ route('registros.create.material', ['id_registro'=>$registro->id_registro]) }}" class="btn btn-info"><i class="glyphicon glyphicon-plus"></i> Agregar Material</a>
                                    @endif
                                    <a href="{{ route('registros.create.trabajo', ['id_registro'=>$registro->id_registro]) }}" class="btn btn-warning"><i class="glyphicon glyphicon-plus"></i> Agregar Detalle</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </li>
            <li class="list-group-item"><a href="#div2" data-toggle="collapse"><i class="glyphicon glyphicon-barcode"></i> Materiales</a>
                <div id="div2" class="content-collapse collapse" aria-expanded="false" style="height: 0px;">
                    {{ $materiales->links() }}
                    <table class="table table-striped table-bordered table-hover" id="tb-materiales">
                        <thead>
                        <tr>
                            <th style="width: 20%">Tipo</th>
                            <th style="width: 30%">Descripción</th>
                            <th style="width: 10%">Cantidad</th>
                            <th style="width: 10%">Litros</th>
                            <th style="width: 10%">Galones</th>
                            <th style="width: 10%">Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($materiales)>0)
                            @foreach($materiales as $material)
                                <tr>
                                    <td>{{$material->nombre_tipo_material}}</td>
                                    <td>{{$material->descripcion}}</td>
                                    <td>{{$material->cantidad}}</td>
                                    <td>{{$material->litros}}</td>
                                    <td>{{$material->galones}}</td>
                                    <td>
                                        <a href="{{ route('registros.edit.material', ['id_registro'=>$material->id_registro, 'id'=>$material->id_detalle_registro]) }}" class="btn btn-link" data-toggle="tooltip" title="Editar"><i class="glyphicon glyphicon-edit"></i></a>
                                        <a href="javascript: delete_reg('{{ route('registros.delete.material', ['id_registro'=>$material->id_registro, 'id'=>$material->id_detalle_registro]) }}')" class="btn btn-link" data-toggle="tooltip" title="Eliminar"><i class="glyphicon glyphicon-remove"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr role="row">
                                <td  colspan="6">No se han encontrado datos</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                    {{ $materiales->links() }}
                </div>
            </li>
            <li class="list-group-item"><a href="#div3" data-toggle="collapse"><i class="glyphicon glyphicon-list"></i> Detalle</a>
                <div id="div3" class="content-collapse collapse" aria-expanded="false" style="height: 0px;">
                    {{ $detalle->links() }}
                    <table class="table table-striped table-bordered table-hover" id="tb-detalle">
                        <thead>
                        <tr>
                            <th style="width: 25%">Personal</th>
                            <th style="width: 35%">Descripción</th>
                            <th style="width: 10%">Horas</th>
                            <th style="width: 10%">Hora Inicio</th>
                            <th style="width: 10%">Hora Termino</th>
                            <th style="width: 10%">Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($detalle)>0)
                            @foreach($detalle as $item)
                                <tr>
                                    <td>{{$item->nombres}} {{ $item->apellidos }}</td>
                                    <td>{{$item->descripcion}}</td>
                                    <td>{{$item->horas}}</td>
                                    <td>{{$item->hora_inicio}}</td>
                                    <td>{{$item->hora_termino}}</td>
                                    <td>
                                        <a href="#" class="btn btn-link" data-toggle="tooltip" title="Editar"><i class="glyphicon glyphicon-edit"></i></a>
                                        <a href="#" class="btn btn-link" data-toggle="tooltip" title="Eliminar"><i class="glyphicon glyphicon-remove"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr role="row">
                                <td  colspan="6">No se han encontrado datos</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                    {{ $detalle->links() }}
                </div>
            </li>
        </ul>
    </div>
@endsection

@section('scripts')

@endsection