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

    protected function defaults(){
        $this->titleChart = 'REPORTE GRAFICO';
        $this->labels = array();
        $this->dataSets = array();
    }

    public function reporte_gastos(Request $request){
        $this->rangeDates($request);
        $chart = new Chart($this->titleChart, $this->labels, $this->dataSets);
        return view('reportes.gastos.bar', [
            'startDate' => $this->dateArray($request['startDate'], 0, $request['startDate']!=null?0:-1)->dateToString,
            'endDate' => empty($request['endDate']) ? '' : $this->dateArray($request['endDate'], 0,0)->dateToString,
            'chart' => $chart
        ]);
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

        $results = array();

        if ($endDate==null){
            $results = DB::table('registro')
                ->where([
                    'id_tipo_registro'=> $request['id_tipo_registro'],
                    'eliminado' => false
                ])
                ->where('fecha_emision', '>=', castDateTime($startDate->dateToString))->get();
        }else{
            $results = DB::table('registro')
                ->where([
                    'id_tipo_registro'=> $request['id_tipo_registro'],
                    'eliminado' => false
                ])->where([
                    ['fecha_emision', '>=', castDateTime($startDate->dateToString)],
                    ['fecha_emision', '<=', castDateTime($endDate->dateToString)]
                ])->get();
        }

        foreach ($results as $row){
            $this->rowDataSet($row);
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

    private function rowDataSet($row){
        $maquinaria = DB::table('maquinaria')->where('id_maquinaria', $row->id_maquinaria)->first();
        $detalle = DB::table('detalle_registro')
            ->join('material_proveedor', 'material_proveedor.id_material_proveedor', '=', 'detalle_registro.id_material_proveedor')
            ->select('detalle_registro.*','material_proveedor.precio')
            ->where('id_registro', $row->id_registro)
            ->get();
        array_push($this->labels, substr($row->fecha_emision,0,10));
        $suma = 0;
        foreach ($detalle as $item){
            if ($item->cantidad!=null){
                $suma += ($item->cantidad*$item->precio);
            }else{
                if ($item->galones!=null){
                    $suma += ($item->galones*$item->precio);
                }
            }
        }
        $num = (int)rand(0, 20);
        array_push($this->dataSets, [
            'label' => $maquinaria->nombre,
            'backgroundColor' => getRGBAColor($num),
            'borderColor' => getRGBAColor($num+1),
            'borderWidth' => 1,
            'data' => [
                $suma,
            ],
        ]);

    }

}
