<?php
/**
 * Created by PhpStorm.
 * User: andrey
 * Date: 08.10.15
 * Time: 12:17
 */
class model_user extends model
{
    public function get_data()
    {
        return array(

            array(
                'Year' => '2012',
                'Site' => 'http://DunkelBeer.ru',
                'Description' => 'Промо-сайт'
            )
        );
    }
    public function register_user($login, $email, $password)
    {
        $mysqli = new mysqli("linkstore.com", "root", "2486", "linkstore");

        /* проверка соединения */
        if (mysqli_connect_errno()) {
            printf("Не удалось подключиться: %s\n", mysqli_connect_error());
            exit();
        }
        if(isset($_POST['login']) && isset($_POST['email']) && isset($_POST['password']))
        {
            $login = $mysqli->real_escape_string(htmlspecialchars($_POST['login']));
            $email = $mysqli->real_escape_string(htmlspecialchars($_POST['email']));
            $password =$mysqli->real_escape_string(htmlspecialchars($_POST['password']));
            if ($mysqli->real_query('SELECT COUNT(*) FROM `user` WHERE `username` = '.$login.''))
            {
                if (($result = $mysqli->use_result())==0)
                {
                    $mysqli->real_query('INSERT INTO `user` (user_name, user_email, user_password) VALUES ('.$login.','.$email.','.$email.')');
                }
            }

        }
}
}