<?php
/**
 * Created by PhpStorm.
 * User: andrey
 * Date: 07.10.15
 * Time: 12:50
 */
class Controller
{
    private $model;

    public function __construct($model) {
        $this->model = $model;
    }
    public function clicked(){
        $this->model->string = "Updated Data, thankth to MVC and PHP";
    }
}