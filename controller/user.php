<?php

class user extends controller {

    public function login()
    {
        if (!empty($_POST['login']) AND !empty($_POST['password'])) {
            $model = new model_user();
            $login = $model->field_test($_POST['login']);
            $password = $model->field_test($_POST['password']);
            $msg=$model->login_user($login, $password);
            $this->view->msg=$msg;
            $this->view->render('message',$msg);
            header("Refresh:5; http://linkstore.com/");
        }
        else {$this->view->render('login');}
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
            $this->view->msg=$msg;
            $this->view->render('message',$msg);
            header("Refresh:5; http://linkstore.com/");
        }
        else{$this->view->render('register');}
    }

    public function activation()
    {
        $model = new model_user();
        $code=$_GET['code'];
        $model->activation($code);
    }
}