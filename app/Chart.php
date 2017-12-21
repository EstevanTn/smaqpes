<?php

namespace App;

class Chart
{
    public $title;
    protected $data;
    public $width;
    public $height;
    public function __construct($title, array $labels, array $dataSets=[])
    {
        $this->width = 402;
        $this->height = 201;
        $this->title = $title;
        $this->data = Chart::ArrayToObject([
           'labels' => $labels,
            'datasets' => $dataSets
        ]);
    }

    public function data(){
        return json_encode($this->data);
    }

    public function length(){
        return count($this->data->datasets);
    }

    public static function ArrayToObject(array $attributes){
        $object = new \stdClass();
        foreach ($attributes as $key => $value){
            $object->$key = $value;
        }
        return $object;
    }

}
