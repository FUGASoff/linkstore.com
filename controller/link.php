<?php
/**
 * Created by PhpStorm.
 * User: andrey
 * Date: 14.10.15
 * Time: 14:46
 */
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
        $this->view->required_data = $link_result;
        $this->view->render('show_all',$link_result);
    }
    public function show_my()
    {
        $model = new model_link();
        $link_result=$model->show_link(1,$_COOKIE['username']);
        $this->view->required_data = $link_result;
        $this->view->render('show_my',$link_result);
    }
}