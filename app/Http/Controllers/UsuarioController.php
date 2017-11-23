<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsuarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $usuarios = DB::table('usuario')
            ->join('personal', 'personal.id_personal', '=', 'usuario.id_personal')
            ->join('persona', 'persona.id_persona', '=', 'personal.id_persona')
            ->select('usuario.*','persona.id_persona', 'persona.nombres', 'persona.apellidos')
            ->where('usuario.eliminado', 0)
            ->paginate(15);
        return view('usuario.list',[ 'usuarios' => $usuarios ]);
    }

    public function create(){
        $personal = DB::table('personal')
            ->join('persona', 'persona.id_persona', '=', 'personal.id_persona')
            ->select('personal.id_personal', 'persona.nombres', 'persona.apellidos', 'persona.email')
            ->get();
        $roles = DB::table('rol')->get();
        return view('usuario.register', [ 'personal' => $personal, 'roles' => $roles ]);
    }

    public function edit($id){
        $id = (int) $id;
        $personal = DB::table('personal')
            ->join('persona', 'persona.id_persona', '=', 'personal.id_persona')
            ->select('personal.id_personal', 'persona.nombres', 'persona.apellidos', 'persona.email')
            ->get();
        $roles = DB::table('rol')->get();
        $usuario = DB::table('usuario')->where('id', $id)->first();
        return view('usuario.register', [ 'personal' => $personal, 'roles' => $roles, 'usuario' => $usuario ]);
    }

    public function delete($id){
        DB::table('usuario')->where('id', $id)->update([
            'eliminado' => true
        ]);
        return redirect('usuarios')->with('deleted', 'Se ha eliminado el registro.');
    }

    public function store(Request $request){
        if (((int) $request['id']) == 0){
            $this->validate($request, [
                'id_personal' => 'required|numeric|min:1',
                'name' => 'required|max:30',
                'email' => 'required|unique:usuario|max:150',
                'password' => 'required',
                'id_rol' => 'numeric|min:1',
            ]);
            $id = DB::table('usuario')->insertGetId([
                'id_personal' => $request['id_personal'],
                'id_rol' => $request['id_rol'],
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => bcrypt($request['password']),
                'estado' => $request['estado'],
                'eliminado' => false,
                'created_at' => getCurrentDate()
            ]);
            return redirect('usuarios')->with('inserted', 'Se ha insertado el registro ('.$id.') correctamente.');
        }else{
            $this->validate($request, [
                'id_personal' => 'required|numeric|min:1',
                'name' => 'required|max:30',
                'email' => 'required|max:150',
                'id_rol' => 'numeric|min:1',
            ]);
            DB::table('usuario')->where('id', $request['id'])->update([
                'id_personal' => $request['id_personal'],
                'id_rol' => $request['id_rol'],
                'name' => $request['name'],
                'email' => $request['email'],
                'estado' => $request['estado'],
                'updated_at' => getCurrentDate()
            ]);
            return redirect('usuarios')->with('updated', 'Se ha actulizado el registro correctamente.');
        }
    }

    public function updatePassword(Request $request){
        $this->validate($request, [
            'password' => 'required'
        ]);
        DB::table('usuario')->where('id', $request['id'])->update([
            'password' => bcrypt($request['password'])
        ]);
        return redirect('usuarios')->with('info', 'Se ha actualizado la contraseña del usuario: '.$request['id']);
    }
}
