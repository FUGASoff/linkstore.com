<?php
/**
 * Created by PhpStorm.
 * User: andrey
 * Date: 09.10.15
 * Time: 11:43
 */
class error extends controller
{
    public function __construct()
    {
        parent::__construct();
        echo "Error controller";
        echo '<br>';
        $this->view->msg = 'Страницы не существует!';
        $this->view->render('error/index');

    }
}
