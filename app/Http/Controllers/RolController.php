<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RolController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $roles = DB::table('rol')->paginate(15);
        return view('rol.list', [ 'roles' => $roles ]);
    }

    public function store(Request $request){
        if(((int) $request['id_rol']) == 0){
            $this->validate($request, [
                'nombre' => 'required|max:50|unique:rol',
                'descripcion' => 'max:250'
            ]);
            DB::table('rol')->insert([
                'nombre' => $request['nombre'],
                'descripcion' => $request['descripcion']
            ]);
            return redirect('roles')->with('inserted', 'Se ha insertado correctamente el registro.');
        }else{
            DB::table('rol')->where('id_rol', $request['id_rol'])->update([
                'nombre' => $request['nombre'],
                'descripcion' => $request['descripcion']
            ]);
            return redirect('roles')->with('updated', 'Se ha actualizado correctamente el registro.');
        };
    }

    public function create(){
        return view('rol.register');
    }

    public function edit($id){
        $id = (int) $id;
        $rol = DB::table('rol')->where('id_rol', $id)->first();
        return view('rol.register', [ 'rol' => $rol ]);
    }

    public function delete($id){
        $id = (int) $id;
        DB::table('rol')->where('id_rol', $id)->delete();
        return redirect('roles')->with('deleted','Se ha eliminado el registro ('.$id.') correctamente.');
    }
}
