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
        $this->view->render('login');
        if (!empty($_POST['login']) AND !empty($_POST['password'])) {
            $model = new model_user();
            $login = $model->field_test($_POST['login']);
            $password = $model->field_test($_POST['password']);
            $model->login_user($login, $password);
        }
    }
    public function logout()
    {
        session_start();
        setcookie('username', '', time()-1, '/');
        setcookie('password', '', time()-1, '/');
        session_destroy();
        header("Location: http://linkstore.com/");
    }
    public function signup()
    {
        $this->view->render('register');
        if (!empty($_POST['login']) AND !empty($_POST['password']) AND !empty($_POST['email'])) {
            $model = new model_user();
            $login = $model->field_test($_POST['login']);
            $password = $model->field_test($_POST['password']);
            $email = $model->field_test($_POST['email']);
            $model->register_user($login, $email, $password);
        }
    }
}