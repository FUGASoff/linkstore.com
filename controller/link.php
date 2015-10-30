<?php

class link extends controller
{
    public function add()
    {
        $model = new model_link();
        if (isset($_POST['link']) and isset($_POST['description']) and isset($_POST['name']) and isset($_POST['type']) and isset($_SESSION['uid']))
        {
            var_dump($_SESSION['uid']);
            $msg=$model->add_link($_POST['link'], $_POST['description'], $_POST['name'], $_POST['type'], $_SESSION['uid']);
            $view_set = array(
                'body_name' => 'add_link',
                'msg_code'=>$msg['code'],
                'msg'=>$msg['msg']
            );
            $this->view->view_set = $view_set;
            $this->view->render('main_view');
        }
        else
        {
            $view_set = array(
                'body_name' => 'add_link'

            );
            $this->view->view_set = $view_set;
            $this->view->render('main_view');
        }
    }
    public function edit()
    {
        $model = new model_link();
        echo $_GET['linkid'];
        /*if (!empty($_POST['new_link'])){
            echo "1";
            $name='link_address';
            $field=$_POST['new_link'];
            $model->edit_link($name, $field, $_GET['linkid']); }
        if (!empty($_POST['new_description'])){
            echo "2";
            $name='link_description';
            $field=$_POST['new_description'];
            $model->edit_link($name, $field,$_GET['linkid']); }
        if (!empty($_POST['new_name'])){
            echo "3";
            $name='link_name';
            $field=$_POST['new_name'];
            $model->edit_link($name, $field, $_GET['linkid']); }
        if (!empty($_POST['new_type'])){
            echo "4";
            $name='link_type';
            $field=$_POST['new_type'];
            $model->edit_link($name, $field, $_GET['linkid']); }*/
            $this->view->required_data=$_POST;
            $view_set = array(
                'body_name' => 'edit_link'

            );
            $this->view->view_set = $view_set;
            $this->view->render('main_view');

    }
    public function delete()
    {
        $model = new model_link();
    }
    public function show_all()
    {
        if(isset($_GET['page'])) {
            $page = $_GET['page'];
            global $per_page;
            $start = 1;
            if ($page == 0) {
                $stop = $start + $per_page;
            } else {
                $start = $start + ($page * $per_page);
                $stop = $start + $per_page;
            }
            $model = new model_link();
            $link_result = $model->show_link(0, 0, $start - 1, $stop - 1);
            $numbers_of_pages = $model->show_link(0, 0);
            $numbers_of_pages = count($numbers_of_pages) / $per_page;
            $view_set = array(
                'body_name' => 'show_all'
            );
            $this->view->number_of_pages = $numbers_of_pages;
            $this->view->required_data = $link_result;
            $this->view->view_set = $view_set;
            $this->view->render('main_view');
        }
    }
    public function show_my()
    {
        if(isset($_GET['page'])) {
            $page = $_GET['page'];
            global $per_page;
            $start = 1;
            if ($page == 0) {
                $stop = $start + $per_page;
            } else {
                $start = $start + ($page * $per_page);
                $stop = $start + $per_page;
            }
            $model = new model_link();
            $link_result = $model->show_link(1, $_SESSION['uid'], $start-1, $stop-1);
            $numbers_of_pages = $model->show_link(1, $_SESSION['uid']);
            $numbers_of_pages = count($numbers_of_pages) / $per_page;
            $view_set = array(
                'body_name' => 'show_my'
            );
            $this->view->required_data = $link_result;
            $this->view->number_of_pages = $numbers_of_pages;
            $this->view->view_set = $view_set;
            $this->view->render('main_view');
        }
    }
}