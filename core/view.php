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
<<<<<<< HEAD
    public function render($name, $VIEW_SET = NULL)
=======
    public function render($name, $data = NULL)
>>>>>>> f1e5d19b93c13a54aca5b9e9dcb38724149ba621
    {
        $file='view/' . $name . '.php';

        require $file;
<<<<<<< HEAD
=======
        return $this->$data;
>>>>>>> f1e5d19b93c13a54aca5b9e9dcb38724149ba621
    }
}