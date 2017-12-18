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
        $maquinarias = DB::table('maquinaria')->where('eliminado', false)->get();
        $tipos_material = DB::table('tipo_material')->get();
        return view('horasmantenimiento.register',[
            'maquinarias' => $maquinarias,
            'tipos_material' => $tipos_material
        ]);
    }

    public function edit($id){
        $maquinarias = DB::table('maquinaria')->where('eliminado', false)->get();
        $entity = DB::table('horas_mantenimiento')->where('id_horas_mantenimiento', $id)->first();
        $tipos_material = DB::table('tipo_material')->get();
        $detalle = DB::table('detalle_horas_mantenimiento')
            ->join('material_proveedor', 'material_proveedor.id_material_proveedor','=','detalle_horas_mantenimiento.id_material_proveedor')
            ->select('detalle_horas_mantenimiento.*', 'material_proveedor.nombre as material', 'material_proveedor.precio')
            ->where('id_horas_mantenimiento', $id)->paginate(10);
        return view('horasmantenimiento.register',[
            'maquinarias' => $maquinarias,
            'entity' => $entity,
            'detalle' => $detalle,
            'tipos_material' => $tipos_material
        ]);
    }

    public function delete(Request $request){
        try{
            DB::table('detalle_horas_mantenimiento')->where('id_horas_mantenimiento', $request['id'])->delete();
            $rows = DB::table('horas_mantenimiento')->where('id_horas_mantenimiento', $request['id'])->delete();
            if ($rows>0){
                return redirect(back()->getTargetUrl())->with('deleted','Se ha eliminado el registro correctamente.');
            }else{
                return redirect(back()->getTargetUrl())->with('error', 'Error al intentar eliminar el registro.');
            }
        }catch (\Exception $ex){
            return redirect(back()->getTargetUrl())->with('error',$ex->getMessage());
        }
    }

    public function store(Request $request){

    }

    public function update(Request $request){

    }

    public function detalle_store(Request $request){
        DB::table('detalle_horas_mantenimiento')->insert([
            'id_horas_mantenimiento' => $request['id_horas_mantenimiento'],
            'tipo_material' => $request['tipo_material'],
            'id_material' => $request['id_material'],
            'id_material_proveedor' => $request['id_material_proveedor'],
            'descripcion' => $request['descripcion'],
            'cantidad' => $request['cantidad'],
            'litros' => $request['litros'],
            'litros' => $request['litros'],
            'galones' => $request['galones'],
            'estado' => $request['estado']
        ]);
        return response()->json([
            'success' => true,
            'message' => 'Se ha insertado correctamente el detalle.'
        ]);
    }

    public function detalle_update(Request $request){
        DB::table('detalle_horas_mantenimiento')
            ->where('id_detalle_horas_mantenimiento', $request['id_detalle_horas_mantenimiento'])
            ->update([
            'id_horas_mantenimiento' => $request['id_horas_mantenimiento'],
            'tipo_material' => $request['tipo_material'],
            'id_material' => $request['id_material'],
            'id_material_proveedor' => $request['id_material_proveedor'],
            'descripcion' => $request['descripcion'],
            'cantidad' => $request['cantidad'],
            'litros' => $request['litros'],
            'litros' => $request['litros'],
            'galones' => $request['galones'],
             'estado' => $request['estado']
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Se ha actualizaod correctamente el detalle.'
        ]);
    }
}
