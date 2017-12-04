<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PersonalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $personal = $this->getAll()
            ->select('persona.*', 'personal.id_area', 'personal.cargo','personal.id_personal', 'personal.sueldo_base',
                'area.nombre as area', 'personal.estado', 'personal.eliminado', 'tipo_documento.siglas')
            ->where([
                'personal.eliminado' => false,
            ])
            ->paginate(15);
        return view('personal.list', [ 'personal' => $personal, ]);
    }

    public function create(){
        return view('personal.register', [ 'tipos_doc' => $this->getAllTipoDocumento(), 'areas' => $this->getAllAreas() ]);
    }

    public function edit($id){
        $personal = $this->getAll()
            ->select('persona.*', 'personal.id_personal', 'personal.fecha_ingreso','personal.fecha_contrato',
                'personal.id_area', 'personal.estado', 'personal.sueldo_base', 'personal.cargo')
            ->where('id_personal', $id)->first();
        return view('personal.register', [
            'tipos_doc' => $this->getAllTipoDocumento(),
            'areas' => $this->getAllAreas() ,
            'personal' => $personal
        ]);
    }

    public function delete($id){
        DB::table('personal')
            ->where('id_personal', $id)
            ->update([
                'eliminado' => true,
            ]);
        return redirect('personal')->with('deleted', 'Se ha eliminado correctamente el registro.');
    }

    public function store(Request $request){
        if (((int) $request['id_personal']) == 0){
            $this->validate($request, [
                'id_tipo_documento' => 'numeric|min:1',
                'numero_documento' => 'required|digits_between:8,20',
                'direccion' => 'nullable|max:150',
                'email' => 'nullable|email|max:100',
                'nombres' => 'required|max:70',
                'apellidos' => 'required|:max:100',
                'fecha_nacimiento' => 'nullable|date|before:01/01/2000',
                'fecha_contrato' => 'nullable|date',
                'fecha_ingreso' => 'nullable|date',
                'cargo' => 'required|max:100',
                'sueldo' => 'required|numeric',
                'id_area' => 'numeric|min:1'
            ]);
            $rows = DB::table('persona')->where('numero_documento' , $request['numero_documento'])->first();
            if ($rows==null){
                $id_persona = DB::table('persona')->insertGetId([
                   'id_tipo_documento'  =>  $request['id_tipo_documento'],
                    'nombres'   =>  $request['nombres'],
                    'apellidos'   =>  $request['apellidos'],
                    'numero_documento'   =>  $request['numero_documento'],
                    'direccion'   =>  $request['direccion'],
                    'email'   =>  $request['email'],
                    'direccion'   =>  $request['direccion'],
                    'fecha_nacimiento'   =>  $request['fecha_nacimiento'],
                    'direccion'   =>  $request['direccion'],
                    'created_at'  => getCurrentDate()
                ]);

            }else{
                $id_persona = $rows->id_persona;
            }
            DB::table('personal')->insert([
                'id_persona' => $id_persona,
                'cargo' => $request['cargo'],
                'id_area' => $request['id_area'],
                'fecha_contrato' => $request['fecha_contrato'],
                'fecha_ingreso' => $request['fecha_ingreso'],
                'estado' => 'A',
                'eliminado' => false,
                'sueldo_base' => $request['sueldo'],
                'created_at' => getCurrentDate()
            ]);
            return redirect('personal')->with('inserted', 'Se ha insertado correctamente un registro.');
        }else{
            $this->validate($request, [
                'id_tipo_documento' => 'numeric|min:1',
                'numero_documento' => 'required|digits_between:8,20',
                'direccion' => 'nullable|max:150',
                'email' => 'nullable|email|max:100',
                'nombres' => 'required|max:70',
                'apellidos' => 'required|:max:100',
                'fecha_nacimiento' => 'nullable|date|before:01/01/2000',
                'fecha_contrato' => 'nullable|date',
                'fecha_ingreso' => 'nullable|date',
                'cargo' => 'required|max:100',
                'sueldo' => 'required|numeric',
                'id_area' => 'numeric|min:1',
            ]);

            $persona = DB::table('persona')->join('personal', 'persona.id_persona', '=', 'personal.id_persona')
                ->select('persona.*')->where('personal.id_personal', $request['id_personal'])->first();

            DB::table('persona')->where('id_persona', $persona->id_persona)->update([
                'numero_documento' => $request['numero_documento'],
                'apellidos' => $request['apellidos'],
                'nombres' => $request['nombres'],
                'id_tipo_documento' => $request['id_tipo_documento'],
                'email' => $request['email'],
                'fecha_nacimiento' => $request['fecha_nacimiento'],
                'direccion' => $request['direccion'],
                'updated_at' => getCurrentDate()
            ]);

            DB::table('personal')->where('id_personal', $request['id_personal'])->update([
                'id_area' => $request['id_area'],
                'fecha_contrato'=> $request['fecha_contrato'],
                'fecha_ingreso'=> $request['fecha_ingreso'],
                'sueldo_base' => $request['sueldo'],
                'estado' => $request['estado'],
                'cargo' => $request['cargo'],
                'updated_at' => getCurrentDate()
            ]);
            return redirect('personal')->with('updated', 'Se ha actualizado correctamente el registro.');
        }
    }

    public function search(Request $request){
        $personals = $this->getAll()
            ->select('persona.*', 'personal.id_area', 'personal.cargo','personal.id_personal', 'personal.sueldo_base',
                'area.nombre as area', 'tipo_documento.siglas');
        if ($request['filter'] == 'nombres'){
            $personals = $personals->where('persona.nombres', 'like', '%'.$request['q'].'%')
                ->orwhere('persona.apellidos', 'like', '%'.$request['q'].'%')
                ->paginate(15);
        }
        if ($request['filter'] == 'nro_doc'){
            $personals = $personals->where('persona.numero_documento', 'like', '%'.$request['q'].'%')
                ->paginate(15);
        }
        if ($request['filter'] == 'cargo'){
            $personals = $personals->where('personal.cargo', 'like', '%'.$request['q'].'%')
                ->paginate(15);
        }
        return view('personal.list', [ 'personal' => $personals, ]);
    }

    public function getAll(){
        return DB::table('personal')
            ->join('persona', 'persona.id_persona', '=', 'personal.id_persona')
            ->join('tipo_documento', 'persona.id_tipo_documento', '=', 'tipo_documento.id_tipo_documento')
            ->join('area', 'area.id_area', '=', 'personal.id_area');
    }

    public function getAllTipoDocumento(){
        return DB::table('tipo_documento')->get();
    }

    public function getAllAreas(){
        return DB::table('area')->where([
            [ 'estado', '=', true ],
            [ 'eliminado', '=', false ]
        ])->get();
    }
}
