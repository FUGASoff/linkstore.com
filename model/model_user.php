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
            if (($result=$database->query('SELECT COUNT(*) FROM `user` WHERE `username` = '.$login.'',MYSQLI_USE_RESULT))==0)
            {
                $res = $database->query('INSERT INTO `user` (user_name, user_email, user_password) VALUES ('.$login.','.$email.','.md5($password).')');
                var_dump($res);
                exit;

            }


        }
        $database->close();
    }
    public function login_user($login, $password)
    {
        $database = new Database();
        if(isset($login) && isset($password))
        {
            $search_user = mysqli_result($database->query("SELECT COUNT(*) FROM `users_profiles` WHERE `username` = '".$login."' AND `password` = '".md5($password)."'"), 0);
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
        $database->close();
    }
    public function modify_user($login, $password, $email)
    {
        $database = new Database();
        if(isset($login) && isset($password))
        {
            $search_user = mysqli_result($database->query("SELECT COUNT(*) FROM `user` WHERE `user_name` = '".$login."' AND `user_password` = '".md5($password)."'"), 0);
            if ($search_user!=0) {
                $data = $database->real_query('SELECT * FROM `user` WHERE user_name = "' . $login . '"');
                if (md5($password) != $data['password']) $database->real_query('UPDATE `user` SET user_password="' . md5($password) . '"WHERE user_name = "' . $login . '"');
                if (md5($password) != $data['password']) $database->real_query('UPDATE `user` SET user_email="' . $email . '"WHERE user_name = "' . $login . '"');
            }
        }
        $database->close();
    }
    public function delete_user($login, $password)
    {
        $database = new Database();
        if(isset($login) && isset($password))
        {
            $login = $database->real_escape_string(htmlspecialchars($_POST['login']));
            $password =$database->real_escape_string(htmlspecialchars($_POST['password']));
            //НЕДОПИСАНО!!!!

        }
        $database->close();
    }
    public function field_test($field)
    {
        $database = new Database();
        //$field=$database->real_escape_string($field);
        $database->close();
        return $field;
    }
}