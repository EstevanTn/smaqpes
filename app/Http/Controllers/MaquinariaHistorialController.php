<?php

namespace App\Http\Controllers;

use App\Http\Requests\MaquinariaHistorialRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MaquinariaHistorialController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request){
        $maquinaria = DB::table('maquinaria')->where('id_maquinaria',$request->id_maquinaria)->first();
        $historiales = DB::table('horas_trabajadas_maquinaria')
            ->where([
                ['id_maquinaria', '=', $request->id_maquinaria],
            ])->paginate(15);
        return view('maquinaria.historial.list', [
            'maquinaria' => $maquinaria,
            'historiales' => $historiales
        ]);
    }
    public function create(Request $request){
        $maquinaria = DB::table('maquinaria')->where('id_maquinaria',$request->id_maquinaria)->first();
        return view('maquinaria.historial.register',
            [
                'maquinaria' => $maquinaria
            ]);
    }
    public function edit($id){
        $entity = DB::table('horas_trabajadas_maquinaria')->where('id_horas_trabajadas_maquinaria', $id)->first();
        $maquinaria = DB::table('maquinaria')->where('id_maquinaria',$entity->id_maquinaria)->first();
        return view('maquinaria.historial.register',
            [
                'maquinaria' => $maquinaria,
                'entity' => $entity
            ]);
    }
    public function store(MaquinariaHistorialRequest $request){
        DB::table('horas_trabajadas_maquinaria')->insert([
            'id_maquinaria' => $request['id_maquinaria'],
            'fecha_trabajo' => $request['fecha'],
            'hora_inicio' => $request['hinicio'],
            'hora_termino' => $request['htermino'],
            'horometro' => $request['horometro'],
            'created_at' => getCurrentDate()
        ]);
        return redirect('maquinarias/'.$request['id_maquinaria'].'/historial')
            ->with('inserted', 'Se ha insertado corretamente el registro.');
    }
    public function update(MaquinariaHistorialRequest $request){
        DB::table('horas_trabajadas_maquinaria')->where('id_horas_trabajadas_maquinaria', $request['id'])->update([
            'id_maquinaria' => $request['id_maquinaria'],
            'horometro' => $request['horometro'],
            'fecha_trabajo' => $request['fecha'],
            'hora_inicio' => $request['hinicio'],
            'hora_termino' => $request['htermino'],
            'created_at' => getCurrentDate()
        ]);
        return redirect('maquinarias/'.$request['id_maquinaria'].'/historial')
            ->with('updated', 'Se ha actualizado corretamente el registro.');
    }
    public function delete(Request $request){
        $rows =DB::table('horas_trabajadas_maquinaria')
            ->where('id_horas_trabajadas_maquinaria', $request->id)
            ->delete();
        if ($rows>0){
            return redirect('maquinarias/'.$request->id_maquinaria.'/historial')
                ->with('deleted', 'Se ha eliminado corretamente el registro.');
        }else{
            return redirect('maquinarias/'.$request->id_maquinaria.'/historial')
                ->with('error', 'Se ha producido un error al tratar de eliminar el registro.');
        }
    }
    public function search(MaquinariaHistorialRequest $request){

    }
}
