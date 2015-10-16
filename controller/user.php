<?php
/**
 * Created by PhpStorm.
 * User: andrey
 * Date: 15.10.15
 * Time: 11:11
 */
class user extends controller {

    public function __construct()
    {
        parent::__construct();
    }
    public function login()
    {
        if (!empty($_POST['login']) AND !empty($_POST['password'])) {
            $model = new model_user();
            $login = $model->field_test($_POST['login']);
            $password = $model->field_test($_POST['password']);
            $model->login_user($login, $password);
            header("Refresh:5; url=", true, 303);
        }
        else {$this->view->render('login');}
    }
    public function logout()
    {
        session_start();
        setcookie('username', '', time()-1, '/');
        setcookie('password', '', time()-1, '/');
        session_destroy();
        header("Refresh:5; url=http://linkstore.com/", true, 303);
    }
    public function signup()
    {

        if (!empty($_POST['login']) AND !empty($_POST['password']) AND !empty($_POST['email'])) {
            $model = new model_user();
            $login = $model->field_test($_POST['login']);
            $password = $model->field_test($_POST['password']);
            $email = $model->field_test($_POST['email']);
            $msg=$model->register_user($login, $email, $password);
            echo $msg;
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