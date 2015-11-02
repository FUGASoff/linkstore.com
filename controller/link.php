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
        global $config;
        $database = new PDO($config['dsn'],$config['user'],$config['pass']);
        $model = new model_link();
        if (isset($_POST['new_link']) and !empty($_POST['new_link'])){
            echo "1";
            $name='link_address';
            echo $_POST['new_adress'];
            $field=$_POST['new_link'];
            $model->edit_link($name, $field, $_GET['linkid']); }
        if (!empty($_POST['new_description']) AND isset($_POST['new_description'])){
            echo "2";
            echo $_POST['new_description'];
            $name='link_description';
            $field=$_POST['new_description'];
            $model->edit_link($name, $field,$_GET['linkid']); }
        if (!empty($_POST['new_name']) AND isset($_POST['new_name'])){
            echo "3";
            echo $_POST['new_name'];
            $name='link_name';
            $field=$_POST['new_name'];
            $model->edit_link($name, $field, $_GET['linkid']); }
        if (!empty($_POST['new_type']) AND isset($_POST['new_type'])){
            echo "4";
            echo $_POST['new_type'];
            $name='link_type';
            $field=$_POST['new_type'];
            $model->edit_link($name, $field, $_GET['linkid']); }
        $sql='SELECT * FROM link WHERE `link_id`="'.$_GET['linkid'].'"';
        $res=$database->query($sql);
        $res->setFetchMode(PDO::FETCH_ASSOC);
        $result=$res->fetch();
        $this->view->required_data=$result;
            $view_set = array(
                'body_name' => 'edit_link'
            );
            $this->view->view_set = $view_set;
            $this->view->render('main_view');

    }
    public function delete()
    {
        $model = new model_link();
        $model->delete_link($_GET['linkid']);
        header("Refresh:0; http://linkstore.com/link/show_my?page=0");
    }
    public function show_all()
    {
        $us_model = new model_user();
        $res=$us_model->check_permission($_SESSION['uid'],'edit_all_links');
        echo $res;
        if($us_model->check_permission($_SESSION['uid'],'edit_all_links'))
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
                $link_result = $model->show_link(0, 1, $start - 1, $stop - 1);
                $numbers_of_pages = $model->show_link(0, 1);
                $numbers_of_pages = count($numbers_of_pages) / $per_page;
                $view_set = array(
                    'body_name' => 'edit_page'
                );
                $this->view->number_of_pages = $numbers_of_pages;
                $this->view->required_data = $link_result;
                $this->view->view_set = $view_set;
                $this->view->render('main_view');
            }
        }
        else
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