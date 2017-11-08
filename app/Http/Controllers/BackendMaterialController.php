<?php

namespace App\Http\Controllers;

use App\Result;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BackendMaterialController extends Controller
{
    public function storeProveedor(Request $request){
        if (((int) $request['id_proveedor']) == 0){
            $id = DB::table('material_proveedor')->insertGetId([
                'id_material' => $request['id_material'],
                'codigo' => $request['codigo_proveedor'],
                'nombre' => $request['nombre_proveedor'],
                'created_at' => Carbon::now()->toDateTimeString()
            ]);
            $url = route('materiales.edit', [ 'id' =>  $request['id_material'] ]);
            return redirect($url)->with('inserted', 'Se ha agregado el proveedor a registro.');
        }else{
            $result = DB::table('material_proveedor')->where('id_material_proveedor', $request['id_proveedor'])
                ->update([
                    'id_material' => $request['id_material'],
                    'codigo' => $request['codigo_proveedor'],
                    'nombre' => $request['nombre_proveedor'],
                    'updated_at' => Carbon::now()->toDateTimeString()
                ]);
            $url = route('materiales.edit', [ 'id' =>  $request['id_material'] ]);
            if ($result){
                return redirect($url)->with('updated', 'Se ha actualizado el proveedor a registro.');
            }else{
                return redirect($url)->with('error', 'Error al intentar actualizar el proveedor del registro.');
            }
        }
    }


}
