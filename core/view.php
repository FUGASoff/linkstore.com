<?php

/**
 * Created by PhpStorm.
 * User: andrey
 * Date: 07.10.15
 * Time: 12:51
 */
class View
{

    public function __construct()
    {

    }
    public function render($name, $VIEW_SET = NULL)
    {
        $file='view/' . $name . '.php';

        require $file;
    }
}