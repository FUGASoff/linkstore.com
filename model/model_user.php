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
        if(isset($login) && isset($email) && isset($password))
        {
            $login = $mysqli->real_escape_string(htmlspecialchars($_POST['login']));
            $email = $mysqli->real_escape_string(htmlspecialchars($_POST['email']));
            $password =$mysqli->real_escape_string(htmlspecialchars($_POST['password']));
            if ($mysqli->real_query('SELECT COUNT(*) FROM `user` WHERE `username` = '.$login.''))
            {
                if (($result = $mysqli->use_result())==0)
                {
                    $mysqli->real_query('INSERT INTO `user` (user_name, user_email, user_password) VALUES ('.$login.','.$email.','.md5($password).')');
                }
            }

        }
    }
    public function login_user($login, $password)
    {
        if(isset($login) && isset($password))
        {
            $login = $mysqli->real_escape_string(htmlspecialchars($_POST['login']));
            $password =$mysqli->real_escape_string(htmlspecialchars($_POST['password']));
            $search_user = mysqli_result($mysqli->real_query("SELECT COUNT(*) FROM `users_profiles` WHERE `username` = '".$login."' AND `password` = '".md5($password)."'"), 0);
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
    }
    public function modify_user($login, $password, $email)
    {
        if(isset($login) && isset($password))
        {
            $login = $mysqli->real_escape_string(htmlspecialchars($_POST['login']));
            $password =$mysqli->real_escape_string(htmlspecialchars($_POST['password']));
            $email = $mysqli->real_escape_string(htmlspecialchars($_POST['email']));
            $search_user = mysqli_result($mysqli->real_query("SELECT COUNT(*) FROM `user` WHERE `user_name` = '".$login."' AND `user_password` = '".md5($password)."'"), 0);
            $data = $mysqli->real_query('SELECT * FROM `user` WHERE user_name = "'.$login.'"');
            if (md5($password)!=$data['password']) $mysqli->real_query('UPDATE `user` SET user_password="'.md5($password).'"WHERE user_name = "'.$login.'"');
            if (md5($password)!=$data['password']) $mysqli->real_query('UPDATE `user` SET user_email="'.$email.'"WHERE user_name = "'.$login.'"');
        }
    }
    public function delete_user($login, $password)
    {
        if(isset($login) && isset($password))
        {
            $login = $mysqli->real_escape_string(htmlspecialchars($_POST['login']));
            $password =$mysqli->real_escape_string(htmlspecialchars($_POST['password']));

        }
    }
}