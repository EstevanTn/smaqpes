<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HorasMantenimientoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $list = DB::table('horas_mantenimiento')
            ->join('maquinaria', 'horas_mantenimiento.id_maquinaria','=', 'maquinaria.id_maquinaria')
            ->select('horas_mantenimiento.*', 'maquinaria.nombre as nombre_maquinaria')
            ->get();
        return view('horasmantenimiento.list', [
            'horas_mantenimiento' => $list
        ]);
    }

    public function create(){
        return view('horasmantenimiento.register');
    }

    public function edit(){
        return view('horasmantenimiento.register');
    }

    public function delete($id){

    }

    public function store(Request $request){

    }

    public function update(Request $request){

    }
}
