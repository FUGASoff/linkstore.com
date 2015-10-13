<?php
/**
 * Created by PhpStorm.
 * User: andrey
 * Date: 13.10.15
 * Time: 14:43
 */
class login extends controller {

    public function __construct()
    {
        parent::__construct();
        $this->view->render('login');
    }
    public function user_login()
    {
        if (!empty($_POST['login']) AND !empty($_POST['password'])) {
            $model = new model_user();
            $login = $model->field_test($_POST['login']);
            $password = $model->field_test($_POST['password']);
            $model->login_user($login, $password);
        }
    }
}
