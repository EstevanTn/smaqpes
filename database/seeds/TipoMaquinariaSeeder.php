<?php

use Illuminate\Database\Seeder;

class TipoMaquinariaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('tipo_maquinaria')
            ->insert([
                'nombre' => 'EXCAVADORA',
                'created_at' => getCurrentDate(),
            ]);
        \Illuminate\Support\Facades\DB::table('tipo_maquinaria')
            ->insert([
                'nombre' => 'MOTONIVELADORA',
                'created_at' => getCurrentDate()
            ]);
        \Illuminate\Support\Facades\DB::table('tipo_maquinaria')
            ->insert([
                'nombre' => 'CARGADOR FRONTAL',
                'created_at' => getCurrentDate(),
            ]);
        \Illuminate\Support\Facades\DB::table('tipo_maquinaria')
            ->insert([
                'nombre' => 'RODILLO VIBRATORIO',
                'created_at' => getCurrentDate(),
            ]);
        \Illuminate\Support\Facades\DB::table('tipo_maquinaria')
            ->insert([
                'nombre' => 'RETROEXCAVADORA',
                'created_at' => getCurrentDate(),
            ]);
        \Illuminate\Support\Facades\DB::table('tipo_maquinaria')
            ->insert([
                'nombre' => 'MINICARGADOR',
                'created_at' => getCurrentDate(),
            ]);
        \Illuminate\Support\Facades\DB::table('tipo_maquinaria')
            ->insert([
                'nombre' => 'VOLQUETE',
                'created_at' => getCurrentDate(),
            ]);
        \Illuminate\Support\Facades\DB::table('tipo_maquinaria')
            ->insert([
                'nombre' => 'CISTERNA',
                'created_at' => getCurrentDate(),
            ]);
    }
}
