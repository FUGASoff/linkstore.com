<?php

class user extends controller {

    public function login()
    {
        if (isset($_POST['login']) AND isset($_POST['password'])) {
            $model = new model_user();
            $login = $model->field_test($_POST['login']);
            $password = $model->field_test($_POST['password']);
            $msg=$model->login_user($login, $password);
            $view_set=array(
                'body_name'=>'login',
                'msg_code'=>$msg['code'],
                'msg'=>$msg['msg']
            );
            $this->view->view_set=$view_set;
            $this->view->render('main_view');
            //header("Refresh:5; http://linkstore.com/");
        }
        else {
            $view_set=array(
                'body_name'=>'login',
            );
            $this->view->view_set=$view_set;
            $this->view->render('main_view');
        }
    }
    public function SendAgain ()
    {
        global $config;
        $database = new PDO($config['dsn'],$config['user'],$config['pass']);
        $model = new model_user();
        if (isset($_POST['login']) AND isset($_POST['password']) AND isset($_POST['email'])){
            $email = $model->field_test($_POST['email']);
            $login = $model->field_test($_POST['login']);
            $password = $model->field_test($_POST['password']);
            $search_user = $database->query("SELECT COUNT(*) as count FROM `user` WHERE `user_name`= '".$login."' AND `user_password`= '".md5($password)."'");
            $search_user->setFetchMode(PDO::FETCH_ASSOC);
            $row = $search_user->fetch();
            if($row['count']!=0)
            {
                $activation=md5($email.time());
                $st=$model->SendMail($email,$login,$activation);
                if ($st) {
                    $msg['code']=1;
                    $msg['msg']='Link sent, check your email';
                }
                else
                {
                    $msg['code']=3;
                    $msg['msg']='Sent failed';
                }
            }
            else
            {
                $msg['code']=3;
                $msg['msg']='User not found';
            }
            $view_set=array(
                'body_name'=>'send_again',
                'msg_code'=>$msg['code'],
                'msg'=>$msg['msg']
            );
            $this->view->view_set=$view_set;
            $this->view->render('main_view');
        }
        else
        {
            $view_set=array(
                'body_name'=>'send_again',
            );
            $this->view->view_set=$view_set;
            $this->view->render('main_view');
        }
    }
    public function logout()
    {
        $model = new model_user();
        $model->logout_user();
        header("Refresh:1; http://linkstore.com/");
    }
    public function signup()
    {

        if (isset($_POST['login']) AND isset($_POST['password']) AND isset($_POST['email'])) {
            $model = new model_user();
            $login = $model->field_test($_POST['login']);
            $password = $model->field_test($_POST['password']);
            $email = $model->field_test($_POST['email']);
            $msg=$model->register_user($login, $email, $password);

            $view_set=array(
                'body_name'=>'register',
                'msg_code'=>$msg['code'],
                'msg'=>$msg['msg']
            );
            $this->view->view_set=$view_set;
            $this->view->render('main_view');
        }
        else
        {
            $view_set=array(
                'body_name'=>'register'
            );
            $this->view->view_set=$view_set;
            $this->view->render('main_view');    
        }
    }
    public function modify($user_id)
    {
        $model = new model_user();
        if (($model->get_id($_SESSION['uid'])) != $user_id) {
            $role = $model->check_permission($_SESSION['uid'], 'edit_all_users');
            if($role){
                if(isset($_POST['email'])){
                    $user_parametrs= array(
                        'user_Id'=>$user_id,
                        'email'=>$_POST['email'],
                        'isadmin'=>true
                    );
                    $msg=$model->modify_user($user_parametrs);
                }
                elseif(isset($_POST['role'])){
                    $user_parametrs= array(
                        'user_Id'=>$user_id,
                        'role'=>$_POST['role'],
                        'isadmin'=>true
                    );
                    $msg=$model->modify_user($user_parametrs);
                }
                else{
                    $msg=array(
                        'code' => 3,
                        'msg' => 'atata'
                    );
                }
                $view_set = array(
                    'body_name' => 'index',
                    'msg_code' => $msg['code'],
                    'msg' => $msg['msg'],
                    'isadmin'=>true
                );
            }
            else{
                $view_set=array(
                    'msg_code'=>3,
                    'msg'=>'Access Denied',
                    'isadmin'=>true
                );
            }
            $this->view->view_set = $view_set;
            $this->view->render('main_view');
        }
        else
            {
            if (isset($_POST['email']))
            {
                $email = $model->field_test($_POST['email']);
                $user_parametrs= array(
                    'user_Id'=>$user_id,
                    'email'=>$email,
                );
                $msg = $model->modify_user($user_parametrs);
                $view_set=array(
                    'user_Id'=>$user_id,
                    'body_name'=>'modify_user',
                    'msg_code'=>$msg['code'],
                    'msg'=>$msg['msg'],
                    'isadmin'=>false
                );
                $this->view->view_set=$view_set;
                $this->view->render('main_view');
            }
            else if(isset($_POST['password']) AND isset($_POST['oldpass']))
            {
                $password = $model->field_test($_POST['password']);
                $oldpass = $model->field_test($_POST['oldpass']);
                $user_parametrs= array(
                    'user_Id'=>$user_id,
                    'oldpass'=>$oldpass,
                    'password'=>$password
                );
                $msg = $model->modify_user($user_parametrs);
                $view_set=array(
                    'user_Id'=>$user_id,
                    'body_name'=>'modify_user',
                    'msg_code'=>$msg['code'],
                    'msg'=>$msg['msg'],
                    'isadmin'=>false
                );
                $this->view->view_set=$view_set;
                $this->view->render('main_view');
                header("Refresh:5; http://linkstore.com/");
            }
            else {
                $view_set = array(
                    'user_Id' => $user_id,
                    'body_name' => 'modify_user',
                    'isadmin'=>false
                );
                $this->view->view_set = $view_set;
                $this->view->render('main_view');
            }
        }
    }

    public function delete($user_id)
    {
        $model = new model_user();
        if (($model->get_id($_SESSION['uid'])) != $user_id) {
            $role = $model->check_permission($_SESSION['uid'], 'edit_all_users');
            if($role){
                $params = array(
                    'user_Id' => $user_id,
                    'isadmin'=>true
                );
                $msg=$model->delete_user($params);
                $view_set = array(
                    'body_name' => 'index',
                    'msg_code' => $msg['code'],
                    'msg' => $msg['msg']
                );
            }
            else
            {
                $view_set=array(
                    'msg_code'=>3,
                    'msg'=>'Access Denied'
                );
            }
        }
        else {
            if (isset($_POST['password'])) {
                $password = $model->field_test($_POST['password']);
                $params = array(
                    'user_Id' => $user_id,
                    'password' => $password
                );
                $msg = $model->delete_user($params);
                $view_set = array(
                    'body_name' => 'index',
                    'msg_code' => $msg['code'],
                    'msg' => $msg['msg']
                );
                $this->view->view_set = $view_set;
                $this->view->render('main_view');
            }
            $view_set = array(
                'user_Id' => $user_id,
                'body_name' => 'modify_user'
            );
        }
        $this->view->view_set = $view_set;
        $this->view->render('main_view');
    }
    public function activation()
    {
        $model = new model_user();
        $code=$_GET['code'];
        $model->activation($code);
    }
    public function admin()
    {
        $model = new model_user();
        $role=$model->check_permission($_SESSION['uid'],'edit_all_users');
        if (!$role){
            if (!isset($_GET['page'])){$page=0;}else{$page=$_GET['page'];}
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
                'body_name' => 'admin_page'
            );
            $this->view->required_data = $link_result;
            $this->view->number_of_pages = $numbers_of_pages;
            $this->view->view_set=$view_set;
            $this->view->render('main_view');
        }
        else
        {

            $view_set=array(
                'msg_code'=>3,
                'msg'=>'Access Denied'
            );
            $this->view->view_set = $view_set;
            $this->view->render('main_view');
        }

    }
}