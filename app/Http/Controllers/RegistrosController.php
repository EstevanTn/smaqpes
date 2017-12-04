<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistroRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegistrosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $registros = DB::table('registro')->join('tipo_registro', 'registro.id_tipo_registro','=','tipo_registro.id_tipo_registro')
            ->join('cliente', 'cliente.id_cliente', '=', 'registro.id_cliente')
            ->join('maquinaria', 'maquinaria.id_maquinaria', '=', 'registro.id_maquinaria')
            ->join('personal as p1', 'p1.id_personal', '=', 'registro.id_operador')
            ->join('persona as pe1', 'pe1.id_persona','=', 'p1.id_persona')
            ->join('personal as p2', 'p2.id_personal', '=', 'registro.id_mecanico')
            ->join('persona as pe2', 'pe2.id_persona','=', 'p2.id_persona')
            ->join('personal as p3', 'p3.id_personal', '=', 'registro.id_jefe_responsable')
            ->join('persona as pe3', 'pe3.id_persona','=', 'p3.id_persona')
            ->select('registro.*','cliente.ruc', 'cliente.razon_social as nombre_cliente',
                'maquinaria.nombre as nombre_maquinaria', DB::raw('pe1.nombres+\' \'+pe1.apellidos as nombre_operador'),
                DB::raw('pe2.nombres+\' \'+pe2.apellidos as nombre_mecanico'),DB::raw('pe3.nombres+\' \'+pe3.apellidos as nombre_responsable'),
                'registro.id_jefe_responsable as id_responsable', 'registro.id_tipo_registro as tipo_registro',
                'tipo_registro.nombre as nombre_tipo')
            ->where('registro.eliminado', false)->paginate(15);
        return view('registros.list', [ 'registros' => $registros ]);
    }

    public function create(){
        $tipos = DB::table('tipo_registro')->where('estado', true)->get();
        return view('registros.create', [ 'tipos' => $tipos ]);
    }

    public function edit($id){
        $tipos = DB::table('tipo_registro')->where('estado', true)->get();
        $registro = DB::table('registro')->join('tipo_registro', 'registro.id_tipo_registro','=','tipo_registro.id_tipo_registro')
            ->join('cliente', 'cliente.id_cliente', '=', 'registro.id_cliente')
            ->join('maquinaria', 'maquinaria.id_maquinaria', '=', 'registro.id_maquinaria')
            ->join('personal as p1', 'p1.id_personal', '=', 'registro.id_operador')
            ->join('persona as pe1', 'pe1.id_persona','=', 'p1.id_persona')
            ->join('personal as p2', 'p2.id_personal', '=', 'registro.id_mecanico')
            ->join('persona as pe2', 'pe2.id_persona','=', 'p2.id_persona')
            ->join('personal as p3', 'p3.id_personal', '=', 'registro.id_jefe_responsable')
            ->join('persona as pe3', 'pe3.id_persona','=', 'p3.id_persona')
            ->select('registro.*','cliente.ruc', 'cliente.razon_social as nombre_cliente',
                'maquinaria.nombre as nombre_maquinaria', DB::raw('pe1.nombres+\' \'+pe1.apellidos as nombre_operador'),
                DB::raw('pe2.nombres+\' \'+pe2.apellidos as nombre_mecanico'),DB::raw('pe3.nombres+\' \'+pe3.apellidos as nombre_responsable'),
                'registro.id_jefe_responsable as id_responsable', 'registro.id_tipo_registro as tipo_registro')
            ->where('registro.id_registro', $id)->first();
        return view('registros.create', [ 'tipos' => $tipos, 'registro' => $registro ]);
    }

    public function store(Request $request){
        $id = (int) $request['id_registro'];
        if ($id==0){
            $id = DB::table('registro')->insertGetId([
                'id_cliente' => $request['id_cliente'],
                'id_maquinaria' => $request['id_maquinaria'],
                'id_tipo_registro' => $request['tipo_registro'],
                'lugar' => $request['lugar'],
                'fecha_emision' => castDateTime($request['fecha_emision']),
                'hora_inicio_mantto' => $request['hora_inicio_mantto'],
                'hora_salida_viaje' => $request['hora_salida_viaje'],
                'hora_termino_mantto' => $request['hora_termino_mantto'],
                'hora_llegada_viaje' => $request['hora_llegada_viaje'],
                'hora_inicio_mantto' => $request['hora_inicio_mantto'],
                'id_operador' => $request['id_operador'],
                'id_jefe_responsable' => $request['id_responsable'],
                'id_mecanico' => $request['id_mecanico'],
                'horometro' => $request['horometro'],
                'kilometraje' => $request['kilometraje'],
                'estado' => $request['estado'],
                'estado_maquinaria' => $request['estado_maquinaria'],
                'lugar_encontrado' => $request['lugar_encontrado'],
                'total_horas' => $request['total_horas'],
                'observacion' => $request['observacion'],
                'eliminado' => false,
                'created_at' => getCurrentDate(),
            ]);
            return redirect('registros')->with('inserted', "Se ha guardado correctamente el registro.");
        }else{
            DB::table('registro')->where('id_registro', $id)->update([
                'id_cliente' => $request['id_cliente'],
                'id_maquinaria' => $request['id_maquinaria'],
                'id_tipo_registro' => $request['tipo_registro'],
                'lugar' => $request['lugar'],
                'fecha_emision' => castDateTime($request['fecha_emision']),
                'hora_inicio_mantto' => $request['hora_inicio_mantto'],
                'hora_salida_viaje' => $request['hora_salida_viaje'],
                'hora_termino_mantto' => $request['hora_termino_mantto'],
                'hora_llegada_viaje' => $request['hora_llegada_viaje'],
                'hora_inicio_mantto' => $request['hora_inicio_mantto'],
                'id_operador' => $request['id_operador'],
                'id_jefe_responsable' => $request['id_responsable'],
                'id_mecanico' => $request['id_mecanico'],
                'horometro' => $request['horometro'],
                'kilometraje' => $request['kilometraje'],
                'estado' => $request['estado'],
                'estado_maquinaria' => $request['estado_maquinaria'],
                'lugar_encontrado' => $request['lugar_encontrado'],
                'total_horas' => $request['total_horas'],
                'observacion' => $request['observacion'],
                'updated_at' => getCurrentDate(),
            ]);
            return redirect('registros')->with('updated', "Se ha actualizado correctamente el registro.");
        }
    }

    public function delete($id){
        DB::table('registro')->where('id_registro', $id)
            ->update([
                'eliminado' => true,
            ]);
        return redirect('registros')->with('deleted', "Se ha eliminado correctamente el registro.");
    }

    public function search(Request $request){

    }

    public function detalle($id){
        $registro = DB::table('registro')->where('id_registro', $id)->first();
        $materiales = DB::table('detalle_registro')
            ->join('material', 'detalle_registro.id_material','=','material.id_material')
            ->join('tipo_material', 'material.id_tipo_material', '=', 'tipo_material.id_tipo_material')
            ->select('detalle_registro.*', 'material.nombre as nombre_material', 'tipo_material.nombre as nombre_tipo_material')
            ->where([
                'detalle_registro.eliminado' => false,
                'detalle_registro.id_registro' => $id
            ])->get();
        $detalle = DB::table('horas_trabajadas')
            ->join('personal', 'personal.id_personal', '=', 'horas_trabajadas.id_personal')
            ->join('persona', 'persona.id_persona', '=', 'personal.id_persona')
            ->select('horas_trabajadas.*', 'persona.id_persona','persona.nombres','persona.apellidos')
            ->where('horas_trabajadas.id_registro', $id)->get();
        return view('registros.detalle', [
            'registro' => $registro,
            'materiales' => $materiales,
            'detalle' => $detalle
        ]);
    }
}
