<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BackendMaterialController extends Controller
{
    public function storeProveedor(Request $request){
        $this->validate($request, [
           'id_material' => 'numeric',
            'id_proveedor' => 'numeric',
            'codigo_proveedor' => 'required',
            'nombre_proveedor' => 'required|max:100',
            'descripcion_proveedor' => 'nullable|max:250',
            'precio_proveedor' => 'required|numeric',
        ]);
        if (((int) $request['id_proveedor']) == 0){
            $id = DB::table('material_proveedor')->insertGetId([
                'id_material' => $request['id_material'],
                'codigo' => $request['codigo_proveedor'],
                'nombre' => $request['nombre_proveedor'],
                'descripcion' => $request['descripcion_proveedor'],
                'precio' => $request['precio_proveedor'],
                'created_at' => getCurrentDate()
            ]);
            $url = route('materiales.edit', [ 'id' =>  $request['id_material'] ]);
            return redirect($url)->with('inserted', 'Se ha agregado el proveedor a registro.');
        }else{
            $result = DB::table('material_proveedor')->where('id_material_proveedor', $request['id_proveedor'])
                ->update([
                    'id_material' => $request['id_material'],
                    'codigo' => $request['codigo_proveedor'],
                    'nombre' => $request['nombre_proveedor'],
                    'descripcion' => $request['descripcion_proveedor'],
                    'precio' => $request['precio_proveedor'],
                    'updated_at' => getCurrentDate()
                ]);
            $url = route('materiales.edit', [ 'id' =>  $request['id_material'] ]);
            if ($result){
                return redirect($url)->with('updated', 'Se ha actualizado el proveedor a registro.');
            }else{
                return redirect($url)->with('error', 'Error al intentar actualizar el proveedor del registro.');
            }
        }
    }

    public function getAllMateriales(Request $request){
        switch ($request['tipo']){
            case 'tipo_material':
                return $this->getMaterialesTipo($request['id_tipo_material']);
                break;
            case 'material_proveedor':
                return $this->getMaterialesProveedores($request['id_material']);
            default:
                break;
        }
    }

    private function getMaterialesTipo($id_tipo_material){
        return DB::table('material')->where('id_tipo_material', $id_tipo_material)->get();
    }

    private function getMaterialesProveedores($id_material){
        return DB::table('material_proveedor')->where('id_material', $id_material)->get();
    }

}
