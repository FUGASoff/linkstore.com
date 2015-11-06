<?php

class link extends controller
{
    public function add()
    {
        if (isset($_SESSION['uid'])) {
            $model = new model_link();
            if (isset($_POST['link']) and isset($_POST['description']) and isset($_POST['name']) and isset($_POST['type']) and isset($_SESSION['uid'])) {
                $msg = $model->add_link($_POST['link'], $_POST['description'], $_POST['name'], $_POST['type'], $_SESSION['uid']);
                $view_set = array(
                    'body_name' => 'add_link',
                    'msg_code' => $msg['code'],
                    'msg' => $msg['msg']
                );
            } else {
                $view_set = array(
                    'body_name' => 'add_link'
                );
            }
        }
        else
        {
            $view_set = array(
                'msg_code' => 2,
                'msg' => 'Access Denied. Please login'
            );
        }
            $this->view->view_set = $view_set;
            $this->view->render('main_view');
    }
    public function edit($linkid)
    {
        global $config;
        $database = new PDO($config['dsn'], $config['user'], $config['pass']);
        $us_model=new model_user();
        if (isset($_SESSION['uid'])) {
            $res=$database->query('SELECT `user_Id` FROM `link` WHERE `link_id`="'.$linkid.'"');
            $res->setFetchMode(PDO::FETCH_ASSOC);
            $result = $res->fetch();
            if($result['user_Id']==($us_model->get_id($_SESSION['uid']))){
                $access=true;}
            else
                if($us_model->check_permission($_SESSION['uid'],'edit_all_links'))
                    $access=true; else $access=false;
            if($access) {
                $model = new model_link();
                if (isset($_POST['new_link']) and !empty($_POST['new_link'])) {
                    $name = 'link_address';
                    $field = $_POST['new_link'];
                    $model->edit_link($name, $field, $linkid);
                }
                if (!empty($_POST['new_description']) AND isset($_POST['new_description'])) {
                    $name = 'link_description';
                    $field = $_POST['new_description'];
                    $model->edit_link($name, $field, $linkid);
                }
                if (!empty($_POST['new_name']) AND isset($_POST['new_name'])) {
                    $name = 'link_name';
                    $field = $_POST['new_name'];
                    $model->edit_link($name, $field, $linkid);
                }
                if (isset($_POST['new_type'])) {
                    $name = 'type';
                    $field = $_POST['new_type'];
                    $model->edit_link($name, $field, $linkid);
                }
                $sql = 'SELECT * FROM link WHERE `link_id`="' . $linkid . '"';
                $res = $database->query($sql);
                $res->setFetchMode(PDO::FETCH_ASSOC);
                $result = $res->fetch();
                $this->view->required_data = $result;
                $view_set = array(
                    'linkid' => $linkid,
                    'body_name' => 'edit_link'
                );
            }
            else
                $view_set = array(
                    'msg_code'=>3,
                    'msg'=>'Access Denied.'
                );
        }
        else
        {
            $view_set = array(
                'msg_code'=>2,
                'msg'=>'Access Denied. Please login'
            );
        }
            $this->view->view_set = $view_set;
            $this->view->render('main_view');
    }
    public function delete($linkid)
    {
        if (isset($_SESSION['uid'])) {
            $model = new model_link();
            $model->delete_link($linkid);
            $view_set = array(
                'msg_code'=>1,
                'msg'=>'Link has been deleted'
            );
        }
        else
        {
            $view_set = array(
                'msg_code'=>2,
                'msg'=>'Access Denied. Please login'
            );
        }
        $this->view->view_set = $view_set;
        $this->view->render('main_view');
    }
    public function show_all()
    {
        $us_model = new model_user();
        $model = new model_link();
        if(isset($_SESSION['uid'])){$uid=$_SESSION['uid'];} else {$uid=0;}
        if($us_model->check_permission($uid,'edit_all_links'))
        {
            if (!isset($_GET['page']) or ($_GET['page']<0)){$page=0;}else{$page=$_GET['page'];}
                global $per_page;
                $start = 1;
                if ($page == 0) {
                    $stop = $start + $per_page;
                } else {
                    $start = $start + ($page * $per_page);
                    $stop = $start + $per_page;
                }
                $link_result = $model->show_link(0, 0, $start - 1, $stop - 1);
                $numbers_of_pages = $model->show_link(0, 0, 0, 1000);
                $numbers_of_pages = count($numbers_of_pages) / $per_page;
                $view_set = array(
                    'page'=>$page,
                    'body_name' => 'edit_page'
                );
                $this->view->number_of_pages = $numbers_of_pages;
                $this->view->required_data = $link_result;
                $this->view->view_set = $view_set;
                $this->view->render('main_view');

        }
        else
        {
            if (!isset($_GET['page'])){$page=0;}else{$page=$_GET['page'];}
                global $per_page;
                $start = 1;
                if ($page == 0) {
                    $stop = $start + $per_page;
                } else {
                    $start = $start + ($page * $per_page);
                    $stop = $start + $per_page;
                }
                $link_result = $model->show_link(0, 1, $start - 1, $stop - 1);
                $numbers_of_pages = $model->show_link(0, 1, 0, 1000);
                $numbers_of_pages = count($numbers_of_pages) / $per_page;
                $view_set = array(
                    'page'=>$page,
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
        if(isset($_SESSION['uid'])) {
            if (!isset($_GET['page']) or ($_GET['page']<0)) {
                $page = 0;
            } else {
                $page = $_GET['page'];
            }
            global $per_page;
            $start = 1;
            if ($page == 0) {
                $stop = $start + $per_page;
            } else {
                $start = $start + ($page * $per_page);//1 4  4 7  7 10
                $stop = $start + $per_page;
            }
            $model = new model_link();
            $link_result = $model->show_link(1, $_SESSION['uid'], $start -1, $stop - 1);
            $numbers_of_pages = $model->show_link(1, $_SESSION['uid'], 0, 1000);
            $numbers_of_pages = count($numbers_of_pages) / $per_page;
            $view_set = array(
                'page' => $page,
                'body_name' => 'show_my'
            );
            $this->view->required_data = $link_result;
            $this->view->number_of_pages = $numbers_of_pages;
        }
        else
        {
            $view_set = array(
                'msg_code'=>2,
                'msg'=>'Access Denied. Please login'
            );
        }
        $this->view->view_set = $view_set;
        $this->view->render('main_view');
    }
}