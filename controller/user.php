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
        header("Refresh:2; http://linkstore.com/");
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

    public function modify()
    {
        $model = new model_user();
        if (isset($_POST['email']))
        {
            $email = $model->field_test($_POST['email']);
            $user_parametrs= array(
                'user_Id'=>$_SESSION['user_Id'],
                'email'=>$email,
            );
            $msg = $model->modify_user($user_parametrs);
            $view_set=array(
                'body_name'=>'modify_user',
                'msg_code'=>$msg['code'],
                'msg'=>$msg['msg']
            );
            $this->view->view_set=$view_set;
            $this->view->render('main_view');
        }
        else if(isset($_POST['password']) AND isset($_POST['oldpass']))
        {
            $password = $model->field_test($_POST['password']);
            $oldpass = $model->field_test($_POST['oldpass']);
            $user_parametrs= array(
                'user_Id'=>$_SESSION['user_Id'],
                'oldpass'=>$oldpass,
                'password'=>$password
            );
            $msg = $model->modify_user($user_parametrs);
            $view_set=array(
                'body_name'=>'modify_user',
                'msg_code'=>$msg['code'],
                'msg'=>$msg['msg']
            );
            $this->view->view_set=$view_set;
            $this->view->render('main_view');
            header("Refresh:5; http://linkstore.com/");
        }
        else
        {
            $view_set = array(
                'body_name' => 'modify_user'
            );
            $this->view->view_set = $view_set;
            $this->view->render('main_view');
        }
    }

    public function delete()
    {
        $view_set=array(
            'body_name'=>'modify_user'
        );
        $this->view->view_set=$view_set;
        $this->view->render('main_view');
    }
    public function activation()
    {
        $model = new model_user();
        $code=$_GET['code'];
        $model->activation($code);
    }
}