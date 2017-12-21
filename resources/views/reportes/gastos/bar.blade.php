@extends('layouts.app')

@section('headStyles')
    <style type="text/css">/* Chart.js */
        @-webkit-keyframes chartjs-render-animation{from{opacity:0.99}to{opacity:1}}@keyframes chartjs-render-animation{from{opacity:0.99}to{opacity:1}}.chartjs-render-monitor{-webkit-animation:chartjs-render-animation 0.001s;animation:chartjs-render-animation 0.001s;}</style>
    <script src="{{ asset('plugins/charts/Chart.bundle.js') }}"></script>
    <script src="{{ asset('plugins/charts/samples/utils.js') }}"></script>
@endsection
@section('content')
    <div class="container">
        <div class="col-xs-12">
            @if($chart->length()==0)
                <div class="alert alert-warning">
                    <button class="close" data-dismiss="alert">&times;</button>
                    <h4>No hay datos</h4>
                    <p>No se han encontrado datos para generar el gráfico.</p>
                </div>
            @endif
        </div>
        <div class="col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="glyphicon glyphicon-search"></i> Búsqueda</h4>
                </div>
                <div class="panel-body">
                    <form id="frm-busqueda" method="post" action="{{ route('graphics.search') }}" class="form-horizontal">
                        {{ csrf_field() }}
                        <input type="hidden" value="1" name="id_tipo_registro" id="id_tipo_registro">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group {{ $errors->has('id_tipo_maquinaria')?'has-error':'' }}">
                                    <label for="" class="control-label col-xs-4">Tipo Maquinaria</label>
                                    <div class="col-xs-8">
                                        <select name="id_tipo_maquinaria" id="id_tipo_maquinaria" class="form-control">
                                            <option value="">-- SELECCIONE --</option>
                                            @foreach($tipos_maquinaria as $tipo)
                                                <option value="{{ $tipo->id_tipo_maquinaria }}">{{ $tipo->nombre }}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('id_tipo_maquinaria'))
                                            <span class="help-block"><strong>{{ $errors->first('id_tipo_maquinaria') }}</strong></span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group {{ $errors->has('startDate')?'has-error':'' }}">
                                    <label for="" class="control-label col-xs-4">Fecha Inicio</label>
                                    <div class="col-xs-8">
                                        <input name="startDate" data-toggle="datepicker" id="startDate" type="text" class="form-control" value="{{ $startDate }}">
                                        @if($errors->has('startDate'))
                                            <span class="help-block"><strong>{{ $errors->first('startDate') }}</strong></span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group {{ $errors->has('endDate')?'has-error':'' }}">
                                    <label for="" class="control-label col-xs-4">Fecha Termino</label>
                                    <div class="col-xs-8">
                                        <input data-toggle="datepicker" name="endDate" id="endDate" type="text" class="form-control" value="{{ $endDate }}">
                                        @if($errors->has('endDate'))
                                            <span class="help-block"><strong>{{ $errors->first('endDate') }}</strong></span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="panel-footer">
                    <button onclick="document.getElementById('frm-busqueda').submit()" class="btn btn-success"><i class="glyphicon glyphicon-search"></i> Ver reporte</button>
                </div>
            </div>
        </div>
        <div class="col-xs-12">
            <div class="panel panel-info" id="modal-reporte">
                <div class="panel-heading">
                    <h4 style="cursor: pointer" data-toggle="collapse" data-target="#modal-reporte>.panel-body" class="panel-title"><i class="glyphicon glyphicon-object-align-bottom"></i> Reporte de gastos</h4>
                </div>
                <div class="panel-body collapse in" aria-expanded="true">
                    <canvas id="myChart" width="{{ $chart->width }}" height="{{ $chart->height }}"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        var ctx = document.getElementById("myChart").getContext('2d');
        var barChartData = JSON.parse('<?=$chart->data()?>');
        console.dir(barChartData);
        $(window).ready(function () {
            selectOption({id_tipo_maquinaria: '{{ $id_tipo_maquinaria }}'});
            window.myBar = new Chart(ctx, {
                type: 'bar',
                data: barChartData,
                options: {
                    responsive: true,
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: '{{ $chart->title }}',
                    },
                    /*scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:true
                            }
                        }]
                    }*/
                }
            });
        });
    </script>
@endsection

