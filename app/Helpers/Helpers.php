<?php

function getRolAdmin(){
    return 1;
}
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
    if (strlen($datetimeString)>10){
        $datetimeString = substr($datetimeString, 0, 10);
    }
    $values = explode('-', $datetimeString);
    if ((int)$values[2]>12 &&(int)$values[2]>(int)$values[1]){
        $temp = $values[1];
        $values[1] = $values[2];
        $values[2] = $temp;
        $datetimeString = "$values[0]-$values[1]-$values[2]";
    }
    $date = \Illuminate\Support\Facades\DB::raw("(SELECT CAST('$datetimeString' as DATETIME))");
    return $date;
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

function search_object($objects, $keyFind, $value){
    $exist = null;
    foreach ($objects as $key => $item){
        if ($item[$keyFind] === $value){
            $exist = $item;
            break;
        }
    }
    return $exist;
}

function arrayToObject(array $attributes){
    $object = new \stdClass();
    foreach ($attributes as $key => $value){
        $object->$key = $value;
    }
    return $object;
}

function getColor($num) {
    $hash = md5('color' . $num); // modify 'color' to get a different palette
    return array(
        hexdec(substr($hash, 0, 2)), // r
        hexdec(substr($hash, 2, 2)), // g
        hexdec(substr($hash, 4, 2))); //b
}

function getRGBAColor($num, $opacity=0.6){
    $color = getColor($num);
    return sprintf('rgba(%s, %s, %s, %s)', $color[0], $color[1],$color[2], $opacity );
}