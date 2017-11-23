<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MaterialController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $materiales = DB::table('material')
            ->join('tipo_material', 'material.id_tipo_material', '=', 'tipo_material.id_tipo_material')
            ->select('material.*', 'tipo_material.nombre as tipo')
            ->where('eliminado', false)
            ->paginate(15);
        return view('material.list', [ 'materiales' => $materiales ]);
    }

    public function create(){
        $tipos = DB::table('tipo_material')->get();
        return view('material.register', [ 'tipos' => $tipos ]);
    }

    public function edit($id){
        $tipos = DB::table('tipo_material')->get();
        $material = DB::table('material')->where('id_material', $id)->first();
        $proveedores = DB::table('material_proveedor')->where('id_material', $id)->get();
        return view('material.register', [
            'tipos' => $tipos, 'material' => $material,
            'proveedores' => $proveedores
        ]);
    }

    public function delete($id){
        DB::table('material')->where('id_material', $id)->update([
            'eliminado' => true,
        ]);
        return redirect('materiales')->with('deleted', 'Se ha eliminado correctamente el registro.');
    }

    public function store(Request $request){
        $this->validate($request, [
            'tipo_material' => 'numeric|min:1',
            'nombre' => 'required',
            'codigo_interno' => 'required|max:20'
        ]);
        if (((int) $request['id_material'])==0){
            DB::table('material')->insertGetId([
                'eliminado' => false,
                'id_tipo_material' => $request['tipo_material'],
                'nombre' => $request['nombre'],
                'descripcion' => $request['descripcion'],
                'codigo_interno' => $request['codigo_interno'],
                'estado' => $request['estado'],
                'created_at' => getCurrentDate()
            ]);
            return redirect('materiales')->with('inserted', 'Se ha insertado correctamente el registro.');
        }else{
            DB::table('material')->where('id_material', $request['id_material'])
                ->update([
                    'estado' => $request['estado'],
                    'id_tipo_material' => $request['tipo_material'],
                    'nombre' => $request['nombre'],
                    'descripcion' => $request['descripcion'],
                    'codigo_interno' => $request['codigo_interno'],
                    'estado' => $request['estado'],
                    'updated_at' => getCurrentDate()
                ]);
            return redirect('materiales')->with('updated', 'Se ha actualizado correctamente el registro.');
        }
    }

    public function search(Request $request){
        $materiales = DB::table('material')
            ->join('tipo_material', 'material.id_tipo_material', '=', 'tipo_material.id_tipo_material')
            ->select('material.*', 'tipo_material.nombre as tipo')
            ->where([
                [ 'material.eliminado', '=', false ],
                [ $request['filter'], 'like', '%'.$request['q'].'%' ]
            ])->paginate(15);
        return view('material.list', [ 'materiales' => $materiales ]);
    }
}
