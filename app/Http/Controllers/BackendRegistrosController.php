<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BackendRegistrosController extends Controller
{
    public function getHorasMantenimiento(Request $request){
        $horas = DB::table('horas_mantenimiento')->where([
            'estado' => 'A',
            'id_maquinaria' => $request['id_maquinaria']
        ])->get();
        return response()->json([
           'data' => $horas
        ]);
    }
    public function getDetalleHorasMantenimiento(Request $request){
        $detalle_horas = DB::table('detalle_horas_mantenimiento')
            ->join('material_proveedor','detalle_horas_mantenimiento.id_material','=','material_proveedor.id_material')
            ->select('detalle_horas_mantenimiento.*', 'material_proveedor.id_material_proveedor'
                , 'material_proveedor.codigo as codigo_proveedor','material_proveedor.nombre as nombre_proveedor',
                'material_proveedor.descripcion as descripcion_proveedor',
                'material_proveedor.precio as precio_proveedor')
            ->where('id_horas_mantenimiento', $request['id_horas'])->get();
        return response()->json([
           'data' => $detalle_horas
        ]);
    }
}
