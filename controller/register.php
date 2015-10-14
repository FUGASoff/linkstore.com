<?php
/**
 * Created by PhpStorm.
 * User: andrey
 * Date: 12.10.15
 * Time: 11:26
 */
class register extends controller
{

    public function __construct()
    {
        parent::__construct();
        $this->view->render('register');
    }

    public function user_register()
    {
        if (!empty($_POST['login']) AND !empty($_POST['password']) AND !empty($_POST['email'])) {
            $model = new model_user();
            $login = $model->field_test($_POST['login']);
            $password = $model->field_test($_POST['password']);
            $email = $model->field_test($_POST['email']);
            $model->register_user($login, $email, $password);
        }
    }
}