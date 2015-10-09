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
        echo 'this is view';
        echo '<br>';
    }
    public function render($name)
    {
        require 'views/' . $name . '.php';
    }
}