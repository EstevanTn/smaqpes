<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AreaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $areas = DB::table('area')
            ->where([
                ['eliminado','=', false],
                ['id_area_padre', '=', null]
            ])->get();
        $all_areas = DB::table('area')
            ->where([
                ['eliminado','=', false],
                ['id_area_padre', '<>', null]
            ])->get();
        return view('area.list', ['areas' => $areas, 'all_areas' => $all_areas ]);
    }

    public function create(){
        $areas = DB::table('area')
            ->where('eliminado', false)->get();
        return view('area.register', ['areas'=> $areas]);
    }

    public function edit($id){
        $areas = DB::table('area')
            ->where('eliminado', false)->get();
        $area = DB::table('area')->where('id_area', $id)->first();
        return view('area.register', ['areas'=> $areas, 'area' => $area]);
    }

    public function delete($id){
        $results = DB::table('area')->where('id_area_padre', $id)->get();
        if (count($results)==0){
            DB::table('area')->where('id_area', $id)->update(['eliminado' => true]);
            return redirect('areas')->with('deleted', 'Se ha eliminado correctamente el registro.');
        }else{
            return redirect('areas')->with('warning', 'El registro no se puede eliminar ya que existen relacionados a este.');
        }
    }

    public function store(Request $request){
        $request['id_area_padre'] = $request['id_area_padre'] == '0' ? null : $request['id_area_padre'];
        $this->validate($request, [
            'nombre' => 'required|max:50',
            'descripcion' => 'max:250',
        ]);
        if (((int) $request['id_area']) == 0){
            $id = DB::table('area')->insertGetId([
               'nombre' => $request['nombre'],
               'descripcion' => $request['descripcion'],
               'estado' => $request['estado'],
               'id_area_padre' => $request['id_area_padre'],
            ]);
            return redirect('areas')->with('inserted', 'Se ha insertado correctamente un registro ('.$id.').');
        }else{
            DB::table('area')->where('id_area', $request['id_area'])->update([
                'nombre' => $request['nombre'],
                'descripcion' => $request['descripcion'],
                'estado' => $request['estado'],
                'id_area_padre' => $request['id_area_padre'],
            ]);
            return redirect('areas')->with('updated', 'Se ha actualizado correctamente el registro.');
        }
    }

}
