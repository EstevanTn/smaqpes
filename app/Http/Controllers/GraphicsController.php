<?php

namespace App\Http\Controllers;

use App\Chart;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GraphicsController extends Controller
{
    protected $titleChart;
    protected $labels;
    protected $dataSets;
    protected $keys;

    protected function defaults(){
        $this->titleChart = 'REPORTE GRAFICO';
        $this->labels = array();
        $this->dataSets = array();
        $this->keys = array();
    }

    public function reporte_gastos(Request $request){
        if ($request->isMethod('POST')){
            $this->validate($request,[
               'id_tipo_maquinaria' => 'required|numeric|min:1',
                'startDate' => 'required|date',
                'endDate' => 'nullable|date',
            ]);
        }
        $tipos_maquinaria = DB::table('tipo_maquinaria')->get();
        $this->rangeDates($request);
        $chart = new Chart($this->titleChart, $this->labels, $this->dataSets);
        $chartOptions = [
            'startDate' => $this->dateArray($request['startDate'], 0, $request['startDate']!=null?0:-1)->dateToString,
            'endDate' => empty($request['endDate']) ? '' : $this->dateArray($request['endDate'], 0,0)->dateToString,
            'chart' => $chart,
            'tipos_maquinaria' => $tipos_maquinaria,
            'id_tipo_maquinaria' => !empty($request['id_tipo_maquinaria']) ? $request['id_tipo_maquinaria'] :'',
        ];
        return view('reportes.gastos.bar', $chartOptions);
    }

    private function rangeDates($request){
        $this->defaults();
        $startDate = $request['startDate'];
        $endDate = $request['endDate'];
        $startDate = $this->dateArray($startDate, 0, $request['startDate']!=null?0:-1);
        $this->titleChart = 'REPORTE DE GATOS DEL '.$startDate->dateToString;
        if($endDate!=null && $startDate != '' && strlen($endDate)==10 ){
            $endDate = $this->dateArray($endDate,0, 0);
            $this->titleChart .= ' AL '.$endDate->dateToString;
        }else{
            $endDate = null;
        }

        if ($endDate==null){
            $results = DB::table('registro')
                ->join('maquinaria', 'registro.id_maquinaria','=', 'maquinaria.id_maquinaria')
                ->join('tipo_maquinaria', 'maquinaria.id_tipo_maquinaria','=', 'tipo_maquinaria.id_tipo_maquinaria')
                ->select('registro.*')
                ->where([
                    'registro.id_tipo_registro'=> $request['id_tipo_registro'],
                    'registro.eliminado' => false,
                    'tipo_maquinaria.id_tipo_maquinaria' => $request['id_tipo_maquinaria'],
                ])
                ->where('fecha_emision', '=', castDateTime($startDate->dateToString))->get();
        }else{
            $results = DB::table('registro')
                ->join('maquinaria', 'registro.id_maquinaria','=', 'maquinaria.id_maquinaria')
                ->join('tipo_maquinaria', 'maquinaria.id_tipo_maquinaria','=', 'tipo_maquinaria.id_tipo_maquinaria')
                ->select('registro.*')
                ->where([
                    ['tipo_maquinaria.id_tipo_maquinaria','=', $request['id_tipo_maquinaria']],
                    [ 'registro.id_tipo_registro', '=', $request['id_tipo_registro'] ],
                    [ 'registro.eliminado', '=', false ],
                    [DB::raw('CAST(fecha_emision AS DATE)'), '>=', DB::raw("CAST('$startDate->dateToString' AS DATE)")],
                    [DB::raw('CAST(fecha_emision AS DATE)'), '<=', DB::raw("CAST('$endDate->dateToString' AS DATE)")]
                ])->get();
        }

        foreach ($results as $row){
            $dateKey = str_replace('-','_',substr($row->fecha_emision, 0, 10));
            if (empty($this->keys[$dateKey])){
                $this->keys[$dateKey] = array();
            }
            $this->rowDataSet($row, $dateKey);
        }
    }

    private function dateArray($date, $addDays=0,$addMonth=-1){

        if ($date==null){
            $date = Carbon::now();
        }
        if (gettype($date)=='string') {
            $date = new Carbon($date);
        }
        $date->format('YYYY-mm-dd H:i:s');
        $date->addDays($addDays);
        $date->addMonth($addMonth);
        return arrayToObject([
            'year' => $date->year,
            'month' => $date->month,
            'day' =>$date->day,
            'hour' => $date->hour,
            'minute' => $date->minute,
            'second' => $date->second,
            'dayOfWeek' => $date->dayOfWeek,
            'daysInMonth' => $date->daysInMonth,
            'dayOfYear' => $date->dayOfYear,
            'toString' => $date->toDateTimeString(),
            'dateToString' => substr($date->toDateTimeString(), 0, 10),
            'timeToString' => substr($date->toDateTimeString(), 11),
        ]);
    }

    private function rowDataSet($row, $dateKey){
        $maquinaria = DB::table('maquinaria')->where('id_maquinaria', $row->id_maquinaria)->first();
        $detalle = DB::table('detalle_registro')
            ->join('material_proveedor', 'material_proveedor.id_material_proveedor', '=', 'detalle_registro.id_material_proveedor')
            ->select('detalle_registro.*','material_proveedor.precio')
            ->where('id_registro', $row->id_registro)
            ->get();
        $suma = 0;
        foreach ($detalle as $key => $item){
            if ($item->cantidad!=null){
                $suma += ($item->cantidad*$item->precio);
            }else{
                if ($item->galones!=null){
                    $suma += ($item->galones*$item->precio);
                }
            }
        }
        if (!in_array('m_'.$row->id_maquinaria, $this->keys[$dateKey])){
            array_push($this->keys[$dateKey], 'm_'.$row->id_maquinaria);
            if (!in_array(substr($row->fecha_emision,0,10), $this->labels)){
                array_push($this->labels, substr($row->fecha_emision,0,10));
            }
            $num = (int)rand(0, 20);
            $color = getRGBAColor($num);
            $borderColor = getRGBAColor($num);
            array_push($this->dataSets, [
                'label' => $maquinaria->nombre,
                'backgroundColor' => $color,
                'borderColor' => $borderColor,
                'borderWidth' => 1,
                'data' => [
                    $suma,
                ],
            ]);
        }else{
            foreach ($this->keys[$dateKey] as $key => $value){
                if ($value=='m_'.$maquinaria->id_maquinaria){
                    $data = $this->dataSets[$key]['data'][0];
                    $this->dataSets[$key]['data'][0] = $data + $suma;
                    //array_push($this->dataSets[$key]['data'], $suma);
                }
            }
        }

    }

}
