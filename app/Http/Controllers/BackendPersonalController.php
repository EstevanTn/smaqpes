<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BackendPersonalController extends Controller
{
    public function GetAll(){
        $result = DB::table('personal')
            ->join('persona', 'persona.id_persona', '=', 'personal.id_persona')
            ->join('tipo_documento', 'persona.id_tipo_documento', '=', 'tipo_documento.id_tipo_documento')
            ->join('area', 'area.id_area', '=', 'personal.id_area')
            ->select('persona.*', 'personal.id_area', 'personal.cargo','personal.id_personal', 'personal.sueldo_base',
                'area.nombre as area', 'personal.estado', 'personal.eliminado', 'tipo_documento.siglas')
            ->where([
                'personal.eliminado' => false,
                'personal.estado' => 'A'
            ])->get();
        return response()->json(['data'=>$result]);
    }
}
