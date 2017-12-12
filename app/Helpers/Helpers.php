<?php
/**
 * @return string
 */
function getCurrentDateString(){
    return \Carbon\Carbon::now()->toDateTimeString();
}

/**
 * GetCurrentDate SQLSERVER
 * @return DateTime
 */
function getCurrentDate(){
    return \Illuminate\Support\Facades\DB::raw('(SELECT CURRENT_TIMESTAMP)');
}

function castDateTime($datetimeString){
    return \Illuminate\Support\Facades\DB::raw('(SELECT CAST(\''.$datetimeString.'\' as DATETIME))');
}

function listar_archivos($carpeta){
    $list = array();
    if(is_dir($carpeta)){
        if($dir = opendir($carpeta)){
            while(($archivo = readdir($dir)) !== false){
                if($archivo != '.' && $archivo != '..' && $archivo != '.htaccess'){
                    $list[] = $archivo;
                }
            }
            closedir($dir);
        }
    }
    return $list;
}