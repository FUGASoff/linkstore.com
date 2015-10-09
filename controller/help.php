<?php
/**
 * Created by PhpStorm.
 * User: andrey
 * Date: 09.10.15
 * Time: 11:50
 */
class help extends controller
{
    public function __construct()
    {
        parent::__construct();
        echo "inside HELP";
        echo '<br>';
    }

    public function other($arg = false)
    {
        echo "inside method other of Help";
        echo '<br>';
        echo "Params: ".$arg;
        echo '<br>';
        //require '../model/Help_Model.php';
        //$model = new Help_Model();
    }
}