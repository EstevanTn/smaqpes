<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BackendClienteController extends Controller
{
    public function GetAll(){
        $clientes = DB::table('cliente')
            ->join('persona', 'persona.id_persona', '=', 'cliente.id_persona')
            ->select('cliente.*', 'persona.nombres', 'persona.apellidos')
            ->where('cliente.eliminado', false)->get();
        return response()->json([ 'data' => $clientes]);
    }
}
