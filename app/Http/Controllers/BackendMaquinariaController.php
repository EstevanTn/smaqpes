<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BackendMaquinariaController extends Controller
{
    public function getNombre(Request $request){
        $count = DB::table('maquinaria')->where([
            [ 'eliminado', '=', false ],
            [ 'id_tipo_maquinaria', '=', $request['id'] ]
        ])->count()+1;
        $tipo = DB::table('tipo_maquinaria')->where('id_tipo_maquinaria', $request['id'])->first();
        return response()->json([
           'nombre' => sprintf('%s N°%s', $tipo->nombre, $count)
        ]);
    }
}
