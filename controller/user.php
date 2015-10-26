<?php

class user extends controller {

    public function login()
    {
        if (!empty($_POST['login']) AND !empty($_POST['password'])) {
            $model = new model_user();
            $login = $model->field_test($_POST['login']);
            $password = $model->field_test($_POST['password']);
<<<<<<< HEAD
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
=======
            $model->login_user($login, $password);
            header("Refresh:2; http://linkstore.com/");
        }
        else {$this->view->render('login');}
>>>>>>> f1e5d19b93c13a54aca5b9e9dcb38724149ba621
    }
    public function logout()
    {
        $model = new model_user();
        $model->logout_user();
        header("Refresh:2; http://linkstore.com/");
    }
    public function signup()
    {

        if (!empty($_POST['login']) AND !empty($_POST['password']) AND !empty($_POST['email'])) {
            $model = new model_user();
            $login = $model->field_test($_POST['login']);
            $password = $model->field_test($_POST['password']);
            $email = $model->field_test($_POST['email']);
            $msg=$model->register_user($login, $email, $password);
<<<<<<< HEAD

            $view_set=array(
                'body_name'=>'register',
                'msg_code'=>$msg['code'],
                'msg'=>$msg['msg']
            );
            $this->view->view_set=$view_set;
            $this->view->render('main_view');
            header("Refresh:5; http://linkstore.com/");
        }
        else
        {
            $view_set=array(
                'body_name'=>'register'
            );
            $this->view->view_set=$view_set;
            $this->view->render('main_view');    
        }
=======
            echo $msg;
            header("Refresh:2; http://linkstore.com/");
        }
        else{$this->view->render('register');}
>>>>>>> f1e5d19b93c13a54aca5b9e9dcb38724149ba621
    }

    public function activation()
    {
        $model = new model_user();
        $code=$_GET['code'];
        $model->activation($code);
    }
}