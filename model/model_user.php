<?php

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
                    $res = $database->exec('INSERT INTO `user` (user_name, user_email, user_password)
                                            VALUES ("'.$login.'","'.$email.'","'.md5($password).'")')
                    or die(print_r($database->errorInfo(), true));
                    $res = $database->exec('INSERT INTO `activation` (user_Id, `hash`) VALUES (
                                    (SELECT `user_Id` FROM `user` WHERE `user_name` = "'.$login.'"),"'.$activation.'")')
                    or die(print_r($database->errorInfo(), true));
                    $to=$email;
                    $subject="Подтверждение электронной почты";
                    $body='Здравствуйте! Пожалуйста, подтвердите адрес вашей электронной почты. http://linkstore.com/user/activation?code='.$activation.'</a>';
                    $st=mail($to,$subject,$body);
                    if ($st)
                        {
                            $msg = array(
                                'code' => 1,
                                'msg' => 'Seccess.');
                        }
                    else {
                        $msg=array(
                            'code'=>3,
                            'msg'=>'Fail sendig emali.');
                    }
                }
                else {
                    $msg = array(
                        'code' => 3,
                        'msg' => 'user already exist');
                }
            }
            else
            {
                $msg=array(
                    'code'=>3,
                    'msg'=>'email fail');
            }
        }
        else
        {
            $msg=array(
                'code'=>3,
                'msg'=>'some fields are empty');
        }
        $database = NULL;
        return $msg;
    }
    public function login_user($login, $password)
    {
        global $config;
        $database = new PDO($config['dsn'],$config['user'],$config['pass']);
        $msg='=)';
        if(isset($login) && isset($password))
        {
            $search_user = $database->query("SELECT * FROM `user` WHERE `user_name` = '".$login."' AND `user_password` = '".md5($password)."'");
            $search_user->setFetchMode(PDO::FETCH_ASSOC);
            $row = $search_user->fetch();
            if($row['user_Id'] == 0)
            {
                $msg=array(
                    'code'=>3,
                    'msg'=>'Login or password are incorrect'
                );
            }
            else
            {
                $_SESSION['user_Id'] = $row['user_Id'];
                $_SESSION['uid']=md5($_SERVER['REMOTE_ADDR'].$_SESSION['user_Id'].time());
                $msg=array(
                    'code'=>1,
                    'msg'=>'Seccess'
                );
                $database->query("UPDATE `user` SET `uid`='".md5($_SERVER['REMOTE_ADDR'].$_SESSION['user_Id'])."' WHERE `user_name` = '".$login."'");

            }
        }
        $database = NULL;
        return $msg;
    }
    public function logout_user()
    {
        $_SESSION['user_Id']=NULL;
        $_SESSION['uid']=NULL;
        session_destroy();
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
    public function activation($code)
    {
        global $config;
        $database = new PDO($config['dsn'],$config['user'],$config['pass']);
        $msg='';
        if(!empty($code) && isset($code))
        {
            $search_user = $database->query("SELECT COUNT(*) as count FROM `activation` WHERE `hash` = '".$code."'");
            $search_user->setFetchMode(PDO::FETCH_ASSOC);
            $row = $search_user->fetch();
            if($row['count'] != 0)
            {
                $res = $database->exec("UPDATE `user` SET `user_status`='1' WHERE user_Id=(
                                      SELECT user_Id FROM `activation` WHERE `hash` = '".$code."')")
                or die(print_r($database->errorInfo(), true));
                $res = $database->exec("DELETE FROM `activation` WHERE `hash` = '".$code."'")
                or die(print_r($database->errorInfo(), true));
                $msg="Activated";

            }
            else{$msg ="You account already activated, you should not do this again.";}
        }
        else{$msg ="Failed activation key.";}
        echo $msg;
        $database = NULL;
    }
}