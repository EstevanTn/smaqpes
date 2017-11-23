<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DefaultDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dni_id = DB::table('tipo_documento')->insertGetId([
            'nombre' => 'DOCUMENTO NACIONAL DE IDENTIDAD',
            'siglas' => 'DNI',
            'valor' => '8',
            'created_at' => getCurrentDate(),
        ]);
        $ruc_id = DB::table('tipo_documento')->insertGetId([
            'nombre' => 'REGISTRO UNICO DEL CONTRIBUYENTE',
            'siglas' => 'RUC',
            'valor' => '11',
            'created_at' => getCurrentDate(),
        ]);

        $rol_administrador = DB::table('rol')->insertGetId([
            'nombre'  => 'ADMINISTRADO',
            'descripcion' => 'ADMINISTRADOR DEL SISTEMA',
            'created_at' => getCurrentDate(),
        ]);
        $area_id =DB::table('area')->insertGetId([
            'nombre' => 'DIVISION RENTAL',
            'descripcion' => 'AREA DE DIVISIÓN RENTAL',
            'estado' => true,
            'eliminado' => false,
            'created_at' => getCurrentDate()
        ]);

        $persona_id = DB::table('persona')->insertGetId([
            'id_tipo_documento' => $dni_id,
            'numero_documento' => '32942027',
            'nombres' => 'ROGER IVAN',
            'apellidos' => 'BEDON BERNUY',
            'created_at' => getCurrentDate()
        ]);
        $personal_id = DB::table('personal')->insertGetId([
            'id_persona' => $persona_id,
            'id_area' => $area_id,
            'cargo' => 'GERENTE DE OPERACIONES',
            'sueldo_base' => 1535,
            'estado' => 'A',
            'eliminado' => false,
            'created_at' => getCurrentDate()
        ]);
        DB::table('usuario')->insert([
            'name' => 'ROGER IVAN',
            'email' => 'ROGER',
            'password' => bcrypt('123456'),
            'id_rol' => $rol_administrador,
            'id_personal' => $personal_id,
            'estado' => 'ACTIVO',
            'eliminado' => false,
            'created_at' => getCurrentDate()
        ]);
    }
}
