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
        global $config;
        $database = new PDO($config['dsn'],$config['user'],$config['pass']);
        if((!empty($login)) && (!empty($email)) && (!empty($password)))
        {
            $regex = '/@/';
            if(preg_match($regex, $email))
            {
                $activation=md5($email.time());
                $result = $database->query('SELECT COUNT(*) as count FROM `user` WHERE `user_name` = "'.$login.'"');
                $result->setFetchMode(PDO::FETCH_ASSOC);
                $row = $result->fetch();
                if ($row['count']==0)
                {
                    $res = $database->exec('INSERT INTO `user` (user_name, user_email, user_password,activation)
                                            VALUES ("'.$login.'","'.$email.'","'.md5($password).'","'.$activation.'")')
                    or die(print_r($database->errorInfo(), true));
                    $to=$email;
                    $subject="Подтверждение электронной почты";
                    $body='Здравствуйте! <br/> <br/> Мы должны убедиться в том, что вы человек. Пожалуйста, подтвердите адрес вашей электронной почты, и можете начать использовать ваш аккаунт на сайте. <br/> <br/> <a href="http://linkstore.com/user/'.$activation.'">http://linkstore.com/user/'.$activation.'</a>';
                    $this->Send_Mail($to,$subject,$body);
                    $msg= "Seccess.";
                }
                else{$msg= 'user already exist';}
            }
            else{$msg= 'email fail';}
        }
        else{$msg= 'some fields are empty';}
        $database = NULL;
        return $msg;
    }
    public function login_user($login, $password)
    {
        global $config;
        $database = new PDO($config['dsn'],$config['user'],$config['pass']);
        if(isset($login) && isset($password))
        {
            $search_user = $database->query("SELECT COUNT(*) as count FROM `user` WHERE `user_name` = '".$login."' AND `user_password` = '".md5($password)."'");
            $search_user->setFetchMode(PDO::FETCH_ASSOC);
            $row = $search_user->fetch();
            if($row['count'] == 0)
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
                header("Refresh:5; Location: http://linkstore.com/");
                exit();
            }
        }
        $database = NULL;
    }
    public function modify_user($login, $password, $email)
    {
        global $config;
        $database = new PDO($config['dsn'],$config['user'],$config['pass']);
        if(isset($login) && isset($password))
        {
            $search_user = $database->query("SELECT COUNT(*) as count FROM `user` WHERE `user_name` = '".$login."' AND `user_password` = '".md5($password)."'");
            $search_user->setFetchMode(PDO::FETCH_ASSOC);
            $row = $search_user->fetch();
            if ($row['count']!=0) {
                $data = $database->prepare("SELECT * FROM `user` WHERE user_name = '.$login.'");
                $search_user->execute();
                if (md5($password) != $data['password']) $database->query("UPDATE `user` SET user_password='.md5($password).' WHERE user_name = '. $login .'");
                if (md5($password) != $data['password']) $database->query("UPDATE `user` SET user_email='.$email.' WHERE user_name = ' . $login .'");
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
        return $field;
    }
    public function check_permission()
    {

    }

    public function Send_Mail($to,$subject,$body)
    {
        require '../smtp/class.phpmailer.php';
        $from       = "onefugasoff@gmail.com";
        $mail       = new PHPMailer();
        $mail->IsSMTP(true);            // используем протокол SMTP
        $mail->IsHTML(true);
        $mail->SMTPAuth   = true;                  // разрешить SMTP аутентификацию
        $mail->Host       = "tls://smtp.gmail.com"; // SMTP хост
        $mail->Port       =  587;                    // устанавливаем SMTP порт
        $mail->Username   = "onefugasoff";  //имя пользователя SMTP
        $mail->Password   = "dr_drol1730s";  // SMTP пароль
        $mail->SetFrom($from, 'From Name');
        $mail->AddReplyTo($from,'From Name');
        $mail->Subject    = $subject;
        $mail->MsgHTML($body);
        $address = $to;
        $mail->AddAddress($address, $to);
        $mail->Send();
    }
    public function activation($code)
    {
        global $config;
        $database = new PDO($config['dsn'],$config['user'],$config['pass']);
        $msg='';
        if(!empty($code) && isset($code))
        {
            $search_user = $database->query("SELECT COUNT(*) as count FROM `user` WHERE `activation` = '".$code."'");
            $search_user->setFetchMode(PDO::FETCH_ASSOC);
            $row = $search_user->fetch();
            if($row['count'] == 0)
            {
                $search_user2 = $database->query("SELECT COUNT(*) as count FROM `user`
                                                  WHERE `activation` = '".$code."' AND `user_status`='0'");
                $search_user2->setFetchMode(PDO::FETCH_ASSOC);
                $row2 = $search_user2->fetch();
                if($row['count'] == 1)
                {
                    $res = $database->exec("UPDATE `user` SET `user_status`='1' WHERE activation='$code'")
                    or die(print_r($database->errorInfo(), true));
                }
                else{$msg="Activated";}
            }
            else{$msg ="You account already activated, you should not do this again.";}
        }
        else{$msg ="Failed activation key.";}
        echo $msg;
        $database = NULL;
    }
}