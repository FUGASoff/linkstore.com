<?php

class Index extends controller {

    public function __construct()
    {
        parent::__construct();
        if (isset($_POST['register']))
        {
            $render_file='register';
        }
        elseif (isset($_POST['login']))
        {
            $render_file='login';
        }
        elseif (isset($_POST['add_link']))
        {
            $render_file='add_link';
        }
        else
        {
            $render_file='index';
        }
        $view_set=array(
            'body_name'=>$render_file
        );
        $this->view->view_set=$view_set;
        $this->view->render('main_view');
    }

}
