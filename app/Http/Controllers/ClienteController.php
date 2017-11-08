<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClienteRequest;
use Illuminate\Support\Facades\DB;

class ClienteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $clientes = DB::table('cliente')
            ->join('persona', 'persona.id_persona', '=', 'cliente.id_persona')
            ->select('cliente.*', 'persona.nombres', 'persona.apellidos')
            ->where('cliente.eliminado', false)
            ->paginate(15);
        return view('cliente.list', [ 'clientes' => $clientes ]);
    }
    public function create(){
        return view('cliente.register');
    }
    public function edit($id){
        return view('cliente.register');
    }
    public function update(ClienteRequest $request){

    }
    public function destroy($id){
        DB::table('cliente')->where('id_cliente', $id)
            ->update([
                'eliminado' => true
            ]);
        return redirect('clientes')->with('deleted', 'Se ha eliminado correctamente el registro.');
    }
    public function show(){

    }
    public function store(ClienteRequest $request){

    }

    public function search(Request $request){
        $clientes = DB::table('cliente')
            ->join('persona', 'persona.id_persona', '=', 'cliente.id_persona')
            ->select('cliente.*', 'persona.nombres', 'persona.apellidos')
            ->where([
                [ 'cliente.eliminado', '=', false ],
                [ $request['f'], 'like', '%'.$request['q'].'%'],
            ])->paginate(15);
        return view('cliente.list', [ 'clientes' =>$clientes ]);
    }
}
