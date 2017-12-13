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
}
