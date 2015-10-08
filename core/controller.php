<?php
/**
 * Created by PhpStorm.
 * User: andrey
 * Date: 07.10.15
 * Time: 12:50
 */
class controller {

    public $model;
    public $view;

    function __construct()
    {
        $this->view = new view();
    }

    function action_index()
    {
    }
}
