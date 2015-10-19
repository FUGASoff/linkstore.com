<?php

class Index extends controller {

    public function __construct()
    {
        parent::__construct();
        if ($_POST['register'])
        {
            $this->view->render('register');
        }
        elseif ($_POST['login'])
        {
            $this->view->render('login');
        }
        elseif ($_POST['add_link'])
        {
            $this->view->render('add_link');
        }
        else
        {
            $this->view->render('index');
        }
    }
}
