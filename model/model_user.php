<?php
/**
 * Created by PhpStorm.
 * User: andrey
 * Date: 08.10.15
 * Time: 12:17
 */
class model_user extends model
{
    public function register_user($login, $email, $password)
    {
        $database = new Database();
        if((!empty($login)) && (!empty($email)) && (!empty($password)))
        {
            $result = $database->prepare('SELECT COUNT(*) FROM `user` WHERE `username` = :username');
            $result->execute(array(':username' => $login));
            if ($result==0)
            {
                $res = $database->prepare('INSERT INTO `user` (user_name, user_email, user_password) VALUES ('.$login.','.$email.','.md5($password).')');
                $res->execute();
                exit;
            }
        }
        $database = NULL;
    }
    public function login_user($login, $password)
    {
        $database = new Database();
        if(isset($login) && isset($password))
        {
            $search_user = $database->prepare("SELECT COUNT(*) FROM `user` WHERE `user_name` = '".$login."' AND `user_password` = '".md5($password)."'");
            $search_user->execute();
            if($search_user == 0)
            {
                echo 'Login or password are incorrect';
                exit();
            }
            else
            {
                $time = 60*60*24;
                setcookie('username', $login, time()+$time, '/');
                setcookie('password', md5($password), time()+$time, '/');
                echo 'Seccess';
                exit();
            }
        }
        $database = NULL;
    }
    public function modify_user($login, $password, $email)
    {
        $database = new Database();
        if(isset($login) && isset($password))
        {
            $search_user = $database->prepare("SELECT COUNT(*) FROM `user` WHERE `user_name` = '".$login."' AND `user_password` = '".md5($password)."'");
            $search_user->execute();
            if ($search_user!=0) {
                $data = $database->prepare('SELECT * FROM `user` WHERE user_name = "' . $login . '"');
                $search_user->execute();
                if (md5($password) != $data['password']) $database->query('UPDATE `user` SET user_password="' . md5($password) . '"WHERE user_name = "' . $login . '"');
                if (md5($password) != $data['password']) $database->query('UPDATE `user` SET user_email="' . $email . '"WHERE user_name = "' . $login . '"');
            }
        }
        $database = NULL;
    }
    /*public function delete_user($login, $password)
    {
        $database = new Database();
        if(isset($login) && isset($password))
        {
            //НЕДОПИСАНО!!!!
        }
        $database = NULL;
    }*/
    public function field_test($field)
    {
        $database = new Database();
        //$field=$database->real_escape_string($field);
        $database = NULL;
        return $field;
    }
}