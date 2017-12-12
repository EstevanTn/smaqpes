<?php

namespace App\Http\Controllers;

use App\Http\Requests\MaquinariaHistorialRequest;
use Illuminate\Http\Request;

class MaquinariaHistorialController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request){
        return view('maquinaria.historial.list');
    }
    public function create(Request $request){

    }
    public function edit($id){

    }
    public function store(MaquinariaHistorialRequest $request){

    }
    public function delete($id){

    }
    public function search(MaquinariaHistorialRequest $request){

    }
}
