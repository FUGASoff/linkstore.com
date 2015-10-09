<?php
/**
 * Created by PhpStorm.
 * User: andrey
 * Date: 07.10.15
 * Time: 12:50
 */
class controller {
    function __construct()
    {
        echo "This is controller";
        echo '<br>';
        $this->view = new View();
    }
}
