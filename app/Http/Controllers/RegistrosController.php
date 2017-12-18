<?php

namespace App\Http\Controllers;

use App\Http\Requests\MaterialProveedorRequest;
use App\Http\Requests\RegistroRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            ->leftJoin('personal as p1', 'p1.id_personal', '=', 'registro.id_operador')
            ->leftJoin('persona as pe1', 'pe1.id_persona','=', 'p1.id_persona')
            ->join('personal as p2', 'p2.id_personal', '=', 'registro.id_mecanico')
            ->join('persona as pe2', 'pe2.id_persona','=', 'p2.id_persona')
            ->join('personal as p3', 'p3.id_personal', '=', 'registro.id_jefe_responsable')
            ->join('persona as pe3', 'pe3.id_persona','=', 'p3.id_persona')
            ->select('registro.*','cliente.ruc', 'cliente.razon_social as nombre_cliente',
                'maquinaria.nombre as nombre_maquinaria', DB::raw('pe1.nombres+\' \'+pe1.apellidos as nombre_operador'),
                DB::raw('pe2.nombres+\' \'+pe2.apellidos as nombre_mecanico'),DB::raw('pe3.nombres+\' \'+pe3.apellidos as nombre_responsable'),
                'registro.id_jefe_responsable as id_responsable', 'registro.id_tipo_registro as tipo_registro',
                'tipo_registro.nombre as nombre_tipo')
            ->where('registro.eliminado', false)
            ->orderBy('registro.id_registro', 'desc')
            ->paginate(15);
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
            ->leftJoin('personal as p1', 'p1.id_personal', '=', 'registro.id_operador')
            ->leftJoin('persona as pe1', 'pe1.id_persona','=', 'p1.id_persona')
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
                'id_horas' => (int)$request['id_total_horas'] == 0? null:$request['id_total_horas'],
                'total_horas' => $request['total_horas'],
                'observacion' => $request['observacion'],
                'eliminado' => false,
                'created_at' => getCurrentDate(),
            ]);
            if ((int) $request['id_total_horas']>0){
                $results = DB::table('detalle_horas_mantenimiento')
                    ->where('id_horas_mantenimiento', $request['id_total_horas'])
                    ->get();
                $inserteds = array();
                foreach ($results as $row){
                    array_push($inserteds, [
                        'id_registro' => $id,
                        'id_material' => $row->id_material,
                        'id_material_proveedor' => $row->id_material_proveedor,
                        'tipo_material' => $row->tipo_material,
                        'descripcion' => $row->descripcion,
                        'cantidad' => $row->cantidad,
                        'litros' => $row->litros,
                        'galones' => $row->galones,
                        'estado' => 1,
                        'eliminado' =>false,
                        'created_at' => getCurrentDate()
                    ]);
                }
                DB::table('detalle_registro')->insert($inserteds);
            }
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
            if ((int) $request['id_total_horas']>0){
                $resultsDetalle = DB::table('detalle_horas_mantenimiento')
                    ->where('id_horas_mantenimiento', $request['id_total_horas'])
                    ->get();
                $resultsUpdate = DB::table('detalle_registro')
                    ->where([
                        ['id_registro', '=',$request['id_registro']],
                        ['eliminado', '=', false]
                    ])
                    ->get();
                if(count($resultsDetalle)>count($resultsUpdate)){
                    foreach ($resultsDetalle as $item){
                        $find = search_object($resultsUpdate, 'id_material_proveedor', $item->id_material_proveedor);
                        if ($find===null){
                            DB::table('detalle_registro')->insert([
                                'id_registro' => $id,
                                'id_material' => $item->id_material,
                                'id_material_proveedor' => $item->id_material_proveedor,
                                'tipo_material' => $item->tipo_material,
                                'descripcion' => $item->descripcion,
                                'cantidad' => $item->cantidad,
                                'litros' => $item->litros,
                                'galones' => $item->galones,
                                'estado' => true,
                                'eliminado' =>false,
                                'created_at' => getCurrentDate()
                            ]);
                        }else{
                            DB::table('detalle_registro')->where('id_detalle_registro', $find->id_detalle_registro)
                            ->update(
                                [
                                    'id_registro' => $id,
                                    'id_material' => $item->id_material,
                                    'id_material_proveedor' => $item->id_material_proveedor,
                                    'tipo_material' => $item->tipo_material,
                                    'descripcion' => $item->descripcion,
                                    'cantidad' => $item->cantidad,
                                    'litros' => $item->litros,
                                    'galones' => $item->galones,
                                    'estado' => true,
                                    'eliminado' =>false,
                                    'created_at' => getCurrentDate()
                                ]
                            );
                        }
                    }
                }
            }
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
            ])->paginate(10);
        $detalle = DB::table('horas_trabajadas')
            ->join('personal', 'personal.id_personal', '=', 'horas_trabajadas.id_personal')
            ->join('persona', 'persona.id_persona', '=', 'personal.id_persona')
            ->select('horas_trabajadas.*', 'persona.id_persona','persona.nombres','persona.apellidos')
            ->where('horas_trabajadas.id_registro', $id)->paginate(10);
        return view('registros.detalle', [
            'registro' => $registro,
            'materiales' => $materiales,
            'detalle' => $detalle
        ]);
    }

    public function create_material(Request $request){
        $tipos_material = DB::table('tipo_material')->get();
        return view('registros.register_material',
            [
                'id_registro' => $request->id_registro,
                'tipos_material' => $tipos_material
            ]);
    }

    public function edit_material(Request $request){
        $tipos_material = DB::table('tipo_material')->get();
        $material = DB::table('detalle_registro')
            ->where('id_detalle_registro', $request->id)->first();
        return view('registros.register_material',[
            'id_registro' => $request->id_registro,
            'tipos_material' => $tipos_material,
            'material' => $material
        ]);
    }

    public function delete_material(Request $request){
        $rows = DB::table('detalle_registro')
            ->where('id_detalle_registro', $request->id)
            ->delete();
        $redirect = url(sprintf('/registros/detalle/%s', $request->id_registro));
        if ($rows>0){
            return redirect($redirect)->with('deleted','Se ha eliminado el material del servicio');
        }else{
            return redirect($redirect)->with('error','Se ha producido un error al intentar eliminar el material del servicio');
        }
    }

    public function store_material(Request $request){
        $this->validate($request, [
           'id_detalle_registro' => 'required',
            'id_registro' => 'required',
            'id_tipo_material' => 'required|numeric|min:1',
            'id_material' => 'required|min:1',
            'id_material_proveedor' => 'required|numeric|min:1',
            'descripcion' => 'required|max:250',
            'cantidad' => 'nullable|numeric',
            'litros' => 'nullable|numeric',
            'galones' => 'nullable|numeric',
            'estado' => 'required|numeric'
        ]);
        $redirect = url(sprintf('/registros/detalle/%s', $request['id_registro']));
        if((int) $request['id_detalle_registro']==0){
            DB::table('detalle_registro')->insert([
                'id_registro' => $request['id_registro'],
                'id_material' => $request['id_material'],
                'id_material_proveedor' => $request['id_material_proveedor'],
                'descripcion' => $request['descripcion'],
                'estado' => $request['estado'],
                'cantidad' => $request['cantidad'],
                'litros' => $request['litros'],
                'galones' => $request['galones'],
                'tipo_material' => $request['tipo_material'],
                'created_at'=> getCurrentDate()
            ]);
            return redirect($redirect)->with('inserted','Se ha insertado correctamente el material a este servicio.');
        }else{
            DB::table('detalle_registro')->where('id_detalle_registro', $request['id_detalle_registro'])->update([
                'id_registro' => $request['id_registro'],
                'id_material' => $request['id_material'],
                'id_material_proveedor' => $request['id_material_proveedor'],
                'descripcion' => $request['descripcion'],
                'estado' => $request['estado'],
                'cantidad' => $request['cantidad'],
                'litros' => $request['litros'],
                'galones' => $request['galones'],
                'tipo_material' => $request['tipo_material'],
                'updated_at' =>getCurrentDate()
            ]);
            return redirect($redirect)->with('updated', 'Se ha actualizado correctamente el material a este servicio.');
        }
    }

    public function create_trabajo(Request $request){
        $selectPersonal = null;
        if (isset($request->id_personal)){
            $selectPersonal = (int)$request->id_personal;
        }
        if (Auth::user()->id_rol==getRolAdmin()){
            $redirect = url(sprintf('/registros/detalle/%s', $request->id_registro));
        }else{
            $redirect = url(sprintf('/registros/%s/detalle/personal/%s', $request->id_registro, $request->id_personal));
        }
        return view('registros.register_trabajo', [
            'id_registro' => $request->id_registro,
            'personal' => $this->getAllPersonal(),
            'id_personal' => isset($request->id_personal) ? $request->id_personal : 0,
            'selectPersonal' =>$selectPersonal,
            'redirect' => $redirect
        ]);
    }

    public function edit_trabajo(Request $request){
        $selectPersonal = null;
        if (isset($request->id_personal)){
            $selectPersonal = (int)$request->id_personal;
        }
        if (Auth::user()->id_rol==getRolAdmin()){
            $redirect = url(sprintf('/registros/detalle/%s', $request->id_registro));
        }else{
            $redirect = url(sprintf('/registros/%s/detalle/personal/%s', $request->id_registro, $request->id_personal));
        }
        $trabajo = DB::table('horas_trabajadas')->where('id_horas_trabajadas',$request->id)->first();
        return view('registros.register_trabajo', [
            'id_registro' => $request->id_registro,
            'personal' => $this->getAllPersonal(),
            'id_personal' => isset($request->id_personal) ? $request->id_personal : 0,
            'selectPersonal' => $selectPersonal,
            'trabajo' => $trabajo,
            'redirect' => $redirect
        ]);
    }

    private function getAllPersonal()
    {
        return DB::table('personal')
            ->join('persona', 'personal.id_persona', '=', 'persona.id_persona')
            ->select('personal.*', 'persona.nombres', 'persona.apellidos')
            ->where('eliminado', false)->get();
    }

    public function delete_trabajo(Request $request){
        $rows = DB::table('horas_trabajadas')
            ->where('id_horas_trabajadas', $request->id)
            ->delete();
        if (Auth::user()->id_rol==getRolAdmin()){
            $redirect = url(sprintf('/registros/detalle/%s', $request->id_registro));
        }else{
            $redirect = url(sprintf('/registros/%s/detalle/personal/%s', $request->id_registro, Auth::user()->id_personal));
        }
        if ($rows>0){
            return redirect($redirect)->with('deleted','Se ha eliminado el material del servicio');
        }else{
            return redirect($redirect)->with('error','Se ha producido un error al intentar eliminar el material del servicio');
        }
    }

    public function store_trabajo(Request $request){
        $this->validate($request, [
            'fecha' => 'required|date',
            'horas' => 'required|numeric',
            'hinicio' => 'required',
            'htermino' => 'required',
            'id_personal' => 'required|numeric|min:1',
            'descripcion' => 'required|max:250',
        ]);
        $redirect = $request['redirect'];
        if((int) $request['id_horas_trabajadas']==0){
            DB::table('horas_trabajadas')->insert([
                'id_registro' => $request['id_registro'],
                'horas' => $request['horas'],
                'id_personal' => $request['id_personal'],
                'fecha' => castDateTime($request['fecha']),
                'hora_inicio' => $request['hinicio'],
                'hora_termino' => $request['htermino'],
                'created_at' => getCurrentDate(),
                'descripcion' => $request['descripcion']
            ]);
            return redirect($redirect)->with('inserted','Se ha insertado el detalle del trabajo realizado a este registro.');
        }else{
            DB::table('horas_trabajadas')->where('id_horas_trabajadas', $request['id_horas_trabajadas'])->update([
                'id_registro' => $request['id_registro'],
                'horas' => $request['horas'],
                'id_personal' => $request['id_personal'],
                'fecha' => castDateTime($request['fecha']),
                'hora_inicio' => $request['hinicio'],
                'hora_termino' => $request['htermino'],
                'created_at' => getCurrentDate(),
                'descripcion' => $request['descripcion']
            ]);
            return redirect($redirect)->with('updated','Se ha actualizado el detalle del trabajo realizado de este registro.');
        }
    }

    public function usuario(){
        $servicios = DB::table('registro')
            ->join('tipo_registro', 'registro.id_tipo_registro', '=', 'tipo_registro.id_tipo_registro')
            ->join('maquinaria', 'registro.id_maquinaria', '=', 'maquinaria.id_maquinaria')
            ->select('registro.*', 'tipo_registro.nombre as tipo_servicio', 'maquinaria.nombre as nombre_maquinaria')
            ->where([
                ['registro.eliminado','=', false],
                ['registro.estado', '=', 'I']
            ])->get();
        return view('registros.usuario_servicio', [
            'servicios' => $servicios,
        ]);
    }

    public function usuario_detalle(Request $request){
        $detalle = DB::table('horas_trabajadas')
            ->where('id_personal', $request->id_personal)->get();
        return view('registros.usuario_detalle_servicio',[
            'detalle' => $detalle,
            'id_personal' => $request->id_personal,
            'id_registro' => $request->id_registro
        ]);
    }

}
