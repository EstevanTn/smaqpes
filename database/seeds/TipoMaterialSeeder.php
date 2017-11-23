<?php

use Illuminate\Database\Seeder;

class TipoMaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('tipo_material')
            ->insert([
                'nombre' => 'FILTROS',
                'created_at' => getCurrentDate(),
            ]);
        \Illuminate\Support\Facades\DB::table('tipo_material')
            ->insert([
                'nombre' => 'ACEITES',
                'created_at' => getCurrentDate(),
            ]);
        \Illuminate\Support\Facades\DB::table('tipo_material')
            ->insert([
                'nombre' => 'REPUESTOS',
                'created_at' => getCurrentDate(),
            ]);
    }
}
