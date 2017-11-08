<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegistrosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $registros = DB::table('registro')->where('eliminado', false)->paginate(15);
        return view('registros.list', [ 'registros' => $registros ]);
    }

    public function create(){
        $tipos = DB::table('tipo_registro')->where('estado', true)->get();
        return view('registros.create', [ 'tipos' => $tipos ]);
    }

    public function edit($id){
        $tipos = DB::table('tipo_registro')->where('estado', true)->get();
        return view('registros.create', [ 'tipos' => $tipos ]);
    }

    public function store(Request $request){

    }

    public function delete($id){

    }

    public function search(Request $request){

    }
}
