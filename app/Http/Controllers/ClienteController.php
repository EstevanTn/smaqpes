<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClienteRequest;
use Illuminate\Http\Request;
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
        return view('cliente.list', [ 'clientes' => $clientes, ]);
    }
    public function create(){
        $tipos_documentos = DB::table('tipo_documento')->get();
        return view('cliente.register', [ 'tipos_documentos' => $tipos_documentos ]);
    }
    public function edit($id){
        $cliente = DB::table('cliente')
            ->join('persona', 'persona.id_persona','=','cliente.id_persona')
            ->select('cliente.*','persona.id_tipo_documento', 'persona.numero_documento',
                'persona.nombres', 'persona.apellidos', 'persona.direccion', 'persona.email', 'persona.fecha_nacimiento')
            ->where('cliente.id_cliente', $id)->first();
        $tipos_documentos = DB::table('tipo_documento')->get();
        return view('cliente.register', [ 'cliente' => $cliente, 'tipos_documentos' => $tipos_documentos ]);
    }
    public function update(ClienteRequest $request){
        DB::table('persona')->where('id_persona', $request['id_persona'])
            ->update([
                'id_tipo_documento' => $request['tipo_documento'],
                'numero_documento' => $request['numero_documento'],
                'nombres' => $request['nombres'],
                'apellidos' => $request['apellidos'],
                'direccion' => $request['direccion'],
                'email' => $request['email'],
                'fecha_nacimiento' => $request['fecha_nacimiento'],
                'updated_at' => getCurrentDate()
            ]);
        DB::table('cliente')->where('id_cliente', $request['id_cliente'])
            ->update([
                'id_persona' => $request['id_persona'],
                'ruc' => $request['ruc'],
                'razon_social' => $request['razon_social'],
                'nombre_comercial' => $request['nombre_comercial'],
                'direccion_cliente' => $request['direccion_cliente'],
                'estado' => $request['estado'],
                'updated_at' => getCurrentDate(),
            ]);
        return redirect('clientes')->with('updated', 'Se ha actualizado correctamente el registro.');
    }
    public function delete($id){
        DB::table('cliente')->where('id_cliente', $id)
            ->update([
                'eliminado' => true
            ]);
        return redirect('clientes')->with('deleted', 'Se ha eliminado correctamente el registro.');
    }
    public function store(ClienteRequest $request){
        $id_persona = DB::table('persona')->insertGetId([
            'id_tipo_documento' => $request['tipo_documento'],
            'numero_documento' => $request['numero_documento'],
            'nombres' => $request['nombres'],
            'apellidos' => $request['apellidos'],
            'direccion' => $request['direccion'],
            'email' => $request['email'],
            'fecha_nacimiento' => $request['fecha_nacimiento'],
            'created_at' => getCurrentDate(),
        ]);
        $id_cliente = DB::table('cliente')->insertGetId([
            'id_persona' => $id_persona,
            'ruc' => $request['ruc'],
            'razon_social' => $request['razon_social'],
            'nombre_comercial' => $request['nombre_comercial'],
            'direccion_cliente' => $request['direccion_cliente'],
            'estado' => $request['estado'],
            'created_at' => getCurrentDate()
        ]);
        return redirect('clientes')->with('inserted', 'Se ha guardado correctamente el registro.');
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
