<?php

class link extends controller
{
    public function add()
    {
        $model = new model_link();
        $model->add_link($_POST['link'], $_POST['description'], $_POST['name'], $_POST['type'], $_POST['user']);
        header("Location: http://linkstore.com/");
    }
    public function edit()
    {
        $model = new model_link();
    }
    public function delete()
    {
        $model = new model_link();
    }
    public function show_all()
    {
        $model = new model_link();
        $link_result=$model->show_link(0,$_COOKIE['username']);
        $view_set=array(
            'body_name'=>'show_all'
        );
        $this->view->required_data = $link_result;
        $this->view->view_set=$view_set;
        $this->view->render('main_view');
    }
    public function show_my()
    {
        $model = new model_link();
        $link_result=$model->show_link(1,$_COOKIE['username']);
        $view_set=array(
            'body_name'=>'show_my'
        );
        $this->view->required_data = $link_result;
        $this->view->view_set=$view_set;
        $this->view->render('main_view');
    }
}