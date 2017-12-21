<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaginaPermisoRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PaginasPermisoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $paginas =  DB::table('pagina_permiso')
            ->join('rol', 'pagina_permiso.id_rol','=','rol.id_rol')
            ->select('pagina_permiso.*', 'rol.nombre as rol')
            ->where('estado', true)
            ->paginate(10);
        return view('paginas.list', ['paginas'=> $paginas]);
    }

    public function create(){
        $list = DB::table('rol')->get();
        $paginas_padre = DB::table('pagina_permiso')
            ->join('rol', 'pagina_permiso.id_rol', '=', 'rol.id_rol')
            ->select('pagina_permiso.*', 'rol.nombre as rol')
            ->where([
            'id_pagina_permiso_padre' => null,
            'estado' => true,
        ])->get();
        return view('paginas.register', [ 'roles' => $list, 'paginas_padre' => $paginas_padre ]);
    }

    public function edit($id){
        $list = DB::table('rol')->get();
        $pagina = DB::table('pagina_permiso')->where('id_pagina_permiso', $id)->first();
        $paginas_padre = DB::table('pagina_permiso')
            ->join('rol', 'pagina_permiso.id_rol', '=', 'rol.id_rol')
            ->select('pagina_permiso.*', 'rol.nombre as rol')
            ->where([
                'id_pagina_permiso_padre' => null,
                'estado' => true,
            ])->get();
        return view('paginas.register', [ 'roles' => $list, 'pagina' => $pagina, 'paginas_padre' => $paginas_padre ]);
    }

    public function store(PaginaPermisoRequest $request){
        DB::table('pagina_permiso')->insert([
            'id_pagina_permiso_padre' => (int)$request['id_padre']==0?null:$request['id_padre'],
            'estado' => $request['estado'],
            'id_rol' => $request['id_rol'],
            'text' => $request['text'],
            'icono' => $request['icono'],
            'url' => $request['url']
        ]);
        return redirect('paginas_rol')->with('inserted', 'Se ha insertado correctamente el registro.');
    }

    public function update(PaginaPermisoRequest $request){
        DB::table('pagina_permiso')
            ->where('id_pagina_permiso', $request['id_pagina_permiso'])
            ->update([
                'id_pagina_permiso_padre' => (int)$request['id_padre']==0? null : $request['id_padre'],
                'estado' => $request['estado'],
                'id_rol' => $request['id_rol'],
                'text' => $request['text'],
                'icono' => $request['icono'],
                'url' => $request['url']
            ]);
        return redirect('paginas_rol')->with('updated', 'Se ha actualizado correctamente el registro.');
    }

    public function search(Request $request){
        $paginas =  DB::table('pagina_permiso')
            ->join('rol', 'pagina_permiso.id_rol','=','rol.id_rol')
            ->select('pagina_permiso.*', 'rol.nombre as rol')
            ->where([
                [ 'estado','=',true ],
                [ $request['filtro'], 'LIKE', '%'.$request['q'].'%' ]
            ])->paginate(10);
        return view('paginas.list', ['paginas'=> $paginas]);
    }



}
