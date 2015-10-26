<?php

class error extends controller
{
    public function __construct()
    {
        parent::__construct();
        $view_set=array(
            'body_name'=>'error'
        );
        $this->view->view_set=$view_set;
        $this->view->render('main_view');

    }
}
