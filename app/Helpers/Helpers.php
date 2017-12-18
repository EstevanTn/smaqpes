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
    /*if ((int)$values[2]>12 &&(int)$values[2]>(int)$values[1]){
        $temp = $values[1];
        $values[1] = $values[2];
        $values[2] = $temp;
        $datetimeString = "$values[0]-$values[1]-$values[2]";
    }*/
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

function darken_color($rgb, $darker=2) {

    $hash = (strpos($rgb, '#') !== false) ? '#' : '';
    $rgb = (strlen($rgb) == 7) ? str_replace('#', '', $rgb) : ((strlen($rgb) == 6) ? $rgb : false);
    if(strlen($rgb) != 6) return $hash.'000000';
    $darker = ($darker > 1) ? $darker : 1;

    list($R16,$G16,$B16) = str_split($rgb,2);

    $R = sprintf("%02X", floor(hexdec($R16)/$darker));
    $G = sprintf("%02X", floor(hexdec($G16)/$darker));
    $B = sprintf("%02X", floor(hexdec($B16)/$darker));

    return $hash.$R.$G.$B;
}

function hex2rgba($hex) {
    $hex = str_replace("#", "", $hex);

    switch (strlen($hex)) {
        case 3 :
            $r = hexdec(substr($hex, 0, 1).substr($hex, 0, 1));
            $g = hexdec(substr($hex, 1, 1).substr($hex, 1, 1));
            $b = hexdec(substr($hex, 2, 1).substr($hex, 2, 1));
            $a = 1;
            break;
        case 6 :
            $r = hexdec(substr($hex, 0, 2));
            $g = hexdec(substr($hex, 2, 2));
            $b = hexdec(substr($hex, 4, 2));
            $a = 1;
            break;
        case 8 :
            $a = hexdec(substr($hex, 0, 2)) / 255;
            $r = hexdec(substr($hex, 2, 2));
            $g = hexdec(substr($hex, 4, 2));
            $b = hexdec(substr($hex, 6, 2));
            break;
    }
    $rgba = array($r, $g, $b, $a);

    return 'rgba('.implode(', ', $rgba).')';
}

function rgba2hex($string) {
    $rgba  = array();
    $hex   = '';
    $regex = '#\((([^()]+|(?R))*)\)#';
    if (preg_match_all($regex, $string ,$matches)) {
        $rgba = explode(',', implode(' ', $matches[1]));
    } else {
        $rgba = explode(',', $string);
    }

    $rr = dechex($rgba['0']);
    $gg = dechex($rgba['1']);
    $bb = dechex($rgba['2']);
    $aa = '';

    if (array_key_exists('3', $rgba)) {
        $aa = dechex($rgba['3'] * 255);
    }

    return strtoupper("#$aa$rr$gg$bb");
}