<?php
/**
 * Created by PhpStorm.
 * User: andrey
 * Date: 09.10.15
 * Time: 11:46
 */
class Index extends controller {

    public function __construct()
    {
        parent::__construct();
        $this->view->render('index');

    }
}
