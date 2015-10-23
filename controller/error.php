<?php

class error extends controller
{
    public function __construct()
    {
        parent::__construct();
        $this->view->msg = 'Страницы не существует!';
        $this->view->render('error');

    }
}
