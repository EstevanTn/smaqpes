<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaginasPermisoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $id_administrador = 1;
        $id_trabajador = 2;
        //MENU ADMINISTRADOR
        $id_menu_sistema = DB::table('pagina_permiso')->insertGetId([
            'id_rol' => $id_administrador,
            'icono' => 'glyphicon glyphicon-star-empty',
            'text' => 'SISTEMA',
        ]);
        DB::table('pagina_permiso')->insert([
            [
                'id_pagina_permiso_padre' => $id_menu_sistema,
                'id_rol' => $id_administrador,
                'icono' => 'glyphicon glyphicon-certificate',
                'text' => 'ROLES',
                'url' => 'roles'
            ],
            [
                'id_pagina_permiso_padre' => $id_menu_sistema,
                'id_rol' => $id_administrador,
                'icono' => 'glyphicon glyphicon-lock',
                'text' => 'USUARIOS',
                'url' => 'usuarios'
            ],
            [
                'id_pagina_permiso_padre' => $id_menu_sistema,
                'id_rol' => $id_administrador,
                'icono' => 'glyphicon glyphicon-list',
                'text' => 'PÁGINAS POR ROLES',
                'url' => 'paginas_rol'
            ]
        ]);
        $id_menu_mantenimiento = DB::table('pagina_permiso')->insertGetId([
            'id_rol' => $id_administrador,
            'icono' => 'glyphicon glyphicon-cog',
            'text' => 'MANTENIMIENTO',
        ]);
        DB::table('pagina_permiso')->insert([
            [
                'id_pagina_permiso_padre' => $id_menu_mantenimiento,
                'id_rol' => $id_administrador,
                'icono' => 'glyphicon glyphicon-list-alt',
                'text' => 'ÁREAS',
                'url' => 'areas'
            ],
            [
                'id_pagina_permiso_padre' => $id_menu_mantenimiento,
                'id_rol' => $id_administrador,
                'icono' => 'glyphicon glyphicon-user',
                'text' => 'PERSONAL',
                'url' => 'personal'
            ],
            [
                'id_pagina_permiso_padre' => $id_menu_mantenimiento,
                'id_rol' => $id_administrador,
                'icono' => 'glyphicon glyphicon-pushpin',
                'text' => 'MAQUINARIAS',
                'url' => 'maquinarias'
            ],
            [
                'id_pagina_permiso_padre' => $id_menu_mantenimiento,
                'id_rol' => $id_administrador,
                'icono' => 'glyphicon glyphicon-th-list',
                'text' => 'MATERIALES',
                'url' => 'materiales'
            ]
        ]);
        $id_menu_servicio = DB::table('pagina_permiso')->insertGetId([
            'id_rol' => $id_administrador,
            'icono' => 'glyphicon glyphicon-barcode',
            'text' => 'SERVICIOS',
        ]);
        DB::table('pagina_permiso')->insert([
            [
                'id_pagina_permiso_padre' => $id_menu_servicio,
                'id_rol' => $id_administrador,
                'icono' => 'glyphicon glyphicon-briefcase',
                'text' => 'NUEVO CLIENTE',
                'url' => 'clientes/create'
            ],
            [
                'id_pagina_permiso_padre' => $id_menu_servicio,
                'id_rol' => $id_administrador,
                'icono' => 'glyphicon glyphicon-menu-hamburger',
                'text' => 'LISTA DE CLIENTES',
                'url' => 'clientes'
            ],
            [
                'id_pagina_permiso_padre' => $id_menu_servicio,
                'id_rol' => $id_administrador,
                'icono' => 'glyphicon glyphicon-plus',
                'text' => 'NUEVO SERVICIO',
                'url' => 'registros/create'
            ],
            [
                'id_pagina_permiso_padre' => $id_menu_servicio,
                'id_rol' => $id_administrador,
                'icono' => 'glyphicon glyphicon-list',
                'text' => 'LISTAS DE SERVICIO',
                'url' => 'registros'
            ]
        ]);
        $id_menu_reporte = DB::table('pagina_permiso')->insertGetId([
            'id_rol' => $id_administrador,
            'icono' => 'glyphicon glyphicon-option-vertical',
            'text' => 'REPORTES',
        ]);
        DB::table('pagina_permiso')->insert([
            [
                'id_pagina_permiso_padre' => $id_menu_reporte,
                'id_rol' => $id_administrador,
                'icono' => 'glyphicon glyphicon-object-align-bottom',
                'text' => 'REPORTE GASTOS',
                'url' => 'reporte/graphics/gastos'
            ],
        ]);
        //MENU TRABAJADOR
        DB::table('pagina_permiso')->insert([
            'id_rol' => $id_trabajador,
            'icono' => 'glyphicon glyphicon-list',
            'text' => 'SERVICIOS',
            'url' => 'registros/usuario'
        ]);
    }
}
