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
        $page=$_GET['page'];
        $per_page=3;
        $start=1;
        if($page==0)
        {
            $stop=$start+$per_page;
        }
        else
        {
            $start=$start + ($page*$per_page);
            $stop=$start+$per_page;
        }
        $model = new model_link();
        $link_result=$model->show_link(0,0,$start-1,$stop-1);
        $numbers_of_pages= $model->show_link(0,0);
        $numbers_of_pages=count($numbers_of_pages)/$per_page;
        $view_set=array(
            'body_name'=>'show_all'
        );
        $this->view->number_of_pages = $numbers_of_pages;
        $this->view->required_data = $link_result;
        $this->view->view_set=$view_set;
        $this->view->render('main_view');
    }
    public function show_my()
    {
        $start=1;
        if(!isset($_GET['page']))
        {
            $stop=2;
        }
        else
        {
            $start=$start * (($_GET['page']-1)*2);
            $stop=$start+2;
        }
        $model = new model_link();
        $link_result=$model->show_link(1,$_COOKIE['username'],$start,$stop);
        $view_set=array(
            'body_name'=>'show_my'
        );
        $this->view->required_data = $link_result;
        $this->view->view_set=$view_set;
        $this->view->render('main_view');
    }
}