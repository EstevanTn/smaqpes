<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MaquinariaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $maquinarias = DB::table('maquinaria')->where('eliminado', false)->paginate(15);
        return view('maquinaria.list', ['maquinarias' => $maquinarias]);
    }

    public function create(){
        return view('maquinaria.register');
    }

    public function edit($id){
        return view('maquinaria.register');
    }

    public function delete($id){

    }

    public function store(Request $request){

    }

    public function search(Request $request){

    }
}
