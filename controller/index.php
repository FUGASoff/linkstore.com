<?php

class Index extends controller {


    public function __construct()
    {
        parent::__construct();
        if (isset($_SESSION['uid']))
        {
            $this->reg();
        }
        else
        {
            $this->unreg();
        }
    }

    public function reg()
    {
        $model = new model_link();
        global $per_page;
        $link_result = $model->show_link(1, $_SESSION['uid'], 0, $per_page);
        $this->view->required_data = $link_result;
        $view_set=array(
            'body_name'=>'index'
        );
        $this->view->view_set=$view_set;
        $this->view->render('main_view');
    }

    public function unreg ()
    {
        $model = new model_link();
        global $per_page;
        $link_result = $model->show_link(0, 0, 0, $per_page);
        $this->view->required_data = $link_result;
        $view_set=array(
            'body_name'=>'index'
        );
        $this->view->view_set=$view_set;
        $this->view->render('main_view');
    }
}
