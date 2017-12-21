<?php
use Illuminate\Support\Facades\DB;

function getMenuParents(){
    return DB::table('pagina_permiso')->where([
        'estado' => true,
        'id_rol' => Auth::user()->id_rol,
        'id_pagina_permiso_padre' => null,
    ])->get();
}

function getMenuChilds($id_parent){
    return DB::table('pagina_permiso')->where([
        'estado' => true,
        'id_rol' => Auth::user()->id_rol,
        'id_pagina_permiso_padre' => $id_parent
    ])->get();
}

function getDropdown($link, $childs){
    $html = '<li class="dropdown">';
    $html .= '<a aria-expanded="false" href="#" data-toggle="dropdown" class="dropdown" role="button"><i class="'.$link->icono.'"></i> '.$link->text.'</a>';
    $html .= '<ul class="dropdown-menu">';
    foreach ($childs as $link){
        $html .= getLink($link);
    }
    $html .= '</ul>';
    $html .= '</li>';
    return $html;
}

function getLink($child){
    $url = url($child->url==null?'':$child->url);
    return '<li><a href="'.$url.'"><i class="'.$child->icono.'"></i> '.$child->text.'</a></li>';
}

function getLinksHTML(){
    $html = '';
    if (!Auth::guest()){
        $parents = getMenuParents();
        foreach ($parents as $link){
            $childs = getMenuChilds($link->id_pagina_permiso);
            if(count($childs)>0){
                $html .= getDropdown($link, $childs);
            }else{
                $html .= getLink($link);
            }
        }
    }
    return $html;
}