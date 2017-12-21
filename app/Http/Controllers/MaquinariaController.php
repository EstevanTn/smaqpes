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
        return view('maquinaria.list', [ 'maquinarias' => $maquinarias, ]);
    }

    public function create(){
        $tipos_maquinaria = DB::table('tipo_maquinaria')->get();
        return view('maquinaria.register', [ 'tipos_maquinaria' => $tipos_maquinaria ]);
    }

    public function edit($id){
        $maquinaria = DB::table('maquinaria')
            ->where('id_maquinaria', $id)
            ->first();
        $tipos_maquinaria = DB::table('tipo_maquinaria')->get();
        return view('maquinaria.register', [ 'maquinaria' => $maquinaria, 'tipos_maquinaria' => $tipos_maquinaria ]);
    }

    public function delete($id){
        DB::table('maquinaria')->where('id_maquinaria', $id)
            ->update([
                'eliminado' => true
            ]);
        return redirect('maquinarias')->with('deleted', 'Se ha eliminado correctamente el registro.');
    }

    public function store(Request $request){
        $this->validate($request, [
           'nombre' =>  'required|max:200',
           'anio' =>  'required|numeric',
           'marca' =>  'required|max:50',
           'modelo' =>  'required|max:20',
           'serie_chasis' =>  'required|max:20',
           'serie_motor' =>  'required|max:20',
           'fecha_adquisicion' =>  'required|date',
            'imagen' => 'nullable|max:300'
        ]);
        if (((int) $request['id_maquinaria']) == 0){
            $id = DB::table('maquinaria')->insertGetId([
                'nombre' => $request['nombre'],
                'id_tipo_maquinaria' => $request['tipo_maquinaria'],
                'anio_fabricacion' => $request['anio'],
                'marca' => $request['marca'],
                'modelo' => $request['modelo'],
                'serie_chasis' => $request['serie_chasis'],
                'serie_motor' => $request['serie_motor'],
                'serie_motor' => $request['serie_motor'],
                'fecha_adquisicion' => $request['fecha_adquisicion'],
                'estado' => $request['estado'],
                'imagen' => $request['imagen'],
                'eliminado' => false,
                'created_at' => getCurrentDate()
            ]);
            return redirect('maquinarias')->with('inserted', 'Se ha insertado correctamente el registro.');
        }else{
            DB::table('maquinaria')->where('id_maquinaria', $request['id_maquinaria'])
                ->update([
                    'id_tipo_maquinaria' => $request['tipo_maquinaria'],
                    'nombre' => $request['nombre'],
                    'anio_fabricacion' => $request['anio'],
                    'marca' => $request['marca'],
                    'modelo' => $request['modelo'],
                    'serie_chasis' => $request['serie_chasis'],
                    'serie_motor' => $request['serie_motor'],
                    'imagen' => $request['imagen'],
                    'estado' => $request['estado'],
                    'fecha_adquisicion' => $request['fecha_adquisicion'],
                    'updated_at' => getCurrentDate()
                ]);
            return redirect('maquinarias')->with('updated', 'Se ha actualizado correctamente el registro.');
        }
    }

    public function search(Request $request){
        $maquinarias = DB::table('maquinaria')->where([
            [ 'eliminado', '=', false ],
            [ $request['filter'], 'like', '%'.$request['q'].'%' ]
        ])->paginate(15);
        return view('maquinaria.list', ['maquinarias' => $maquinarias]);
    }

    public function aumentar_horometro(){
        $results = DB::table('maquinaria')->where([
            'eliminado' => false,
            'estado' => true
        ])->get();
        foreach ($results as $item){
            $r = DB::table('horas_trabajadas_maquinaria')->where([
                [DB::raw('CAST(fecha_trabajo AS DATE)'), '=', DB::raw('CAST(GETDATE() AS DATE)')],
                ['id_maquinaria','=',$item->id_maquinaria]
            ])->count();
            if ($r==0){
                DB::table('horas_trabajadas_maquinaria')
                    ->insert([
                        'id_maquinaria' => $item->id_maquinaria,
                        'fecha_trabajo' => getCurrentDate(),
                        'horometro' => 8,
                        'created_at' => getCurrentDate(),
                        'estado' => true
                    ]);
            }
        }
        return redirect(back()->getTargetUrl())->with('info', 'Se ha iniciado el horometro de trabajo de las maquinarias');
    }


}
