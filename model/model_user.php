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
                $result = $database->query('SELECT COUNT(*) as count FROM user WHERE `user_name` = "'.$login.'"');
                $result->setFetchMode(PDO::FETCH_ASSOC);
                $row = $result->fetch();
                if ($row['count']==0)
                {
                    $res = $database->exec('INSERT INTO `user` (user_name, user_email, user_password)
                                            VALUES ("'.$login.'","'.$email.'","'.md5($password).'")')
                    or die(print_r($database->errorInfo(), true));
                    $st=$this->SendMail($email,$login,$activation);
                    if ($st)
                        {
                            $msg = array(
                                'code' => 1,
                                'msg' => 'Success.');
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
            $search_user = $database->query("SELECT * FROM `user` WHERE `user_name` = '".$login."' AND `user_password` = '".md5($password)."' AND `user_status`!= 0 ");
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
                    'msg'=>'Success'
                );
                $database->query("UPDATE `user` SET `uid`='".$_SESSION['uid']."' WHERE `user_name` = '".$login."'");

            }
            if ($row['user_status']==0)
            {
                $search_user = $database->query("SELECT COUNT(*) as count FROM `activation` WHERE `user_Id` = (SELECT `user_Id` FROM `user` WHERE `user_name`='".$login."')");
                $search_user->setFetchMode(PDO::FETCH_ASSOC);
                $row = $search_user->fetch();
                if ($row['count']==0)
                {
                    $msg=array(
                        'code'=>3,
                        'msg'=>'You dont activate your account during 5 days <form><button type="submit" formaction="/user/SendAgain">send link again</button></form>'
                    );
                }
                else
                {
                    $msg = array(
                        'code' => 3,
                        'msg' => 'You should activate you account via email'
                    );
                }
            }
        }
        $database = NULL;
        return $msg;
    }
    public function logout_user($id)
    {
        global $config;
        $database = new PDO($config['dsn'],$config['user'],$config['pass']);
        $res=$database->query("UPDATE `user` SET `uid`=0  WHERE `user_Id`='".$id."'")
        or die(print_r($database->errorInfo(), true));
        $_SESSION['user_Id']=NULL;
        $_SESSION['uid']=NULL;
        session_destroy();
    }
    public function modify_user($params)
    {
        global $config;
        $database = new PDO($config['dsn'],$config['user'],$config['pass']);
        $user_Id=$params['user_Id'];
        $msg='';
        if(isset($params['oldpass']) && isset($params['password']))
        {
            $oldpass=$params['oldpass'];
            $password=$params['password'];
            $result = $database->query('SELECT COUNT(*) as count FROM user WHERE `user_Id` = "'.$user_Id.'" AND `user_password` = "'.md5($oldpass).'"');
            $result->setFetchMode(PDO::FETCH_ASSOC);
            $row = $result->fetch();
            if ($row['count']!=0)
            {
                $database->query('UPDATE user SET `user_password` = "'.md5($password).'" WHERE `user_Id` = "'.$user_Id.'"')
                or die(print_r($database->errorInfo(), true));
                $msg=array(
                    'code'=>1,
                    'msg'=>'Password has been changed'
                );
            }
            else
            {
                $msg=array(
                    'code'=>3,
                    'msg'=>'incorrect data'
                );
            }
        }
        if(isset($params['email']))
        {
            $email=$params['email'];
            $result = $database->query('SELECT COUNT(*) as count FROM user WHERE `user_Id` = "'.$user_Id.'"');
            $result->setFetchMode(PDO::FETCH_ASSOC);
            $row = $result->fetch();
            if ($row['count']!=0)
            {
                $database->query('UPDATE user SET `user_email` = "'.$email.'" WHERE `user_Id` = "'.$user_Id.'"')
                or die(print_r($database->errorInfo(), true));
                $msg=array(
                    'code'=>1,
                    'msg'=>'Email has been changed'
                );
            }
            else
            {
                $msg=array(
                    'code'=>3,
                    'msg'=>'Incorrect data'
                );
            }
        }
        if(isset($params['role']))
        {
            $role=$params['role'];
            $result = $database->query('SELECT COUNT(*) as count FROM user WHERE `user_Id` = "'.$user_Id.'"');
            $result->setFetchMode(PDO::FETCH_ASSOC);
            $row = $result->fetch();
            if ($row['count']!=0)
            {
                $database->query('UPDATE user SET `role_id` = "'.$role.'" WHERE `user_Id` = "'.$user_Id.'"')
                or die(print_r($database->errorInfo(), true));
                $msg=array(
                    'code'=>1,
                    'msg'=>'Role has been changed'
                );
            }
            else
            {
                $msg=array(
                    'code'=>3,
                    'msg'=>'Incorrect data'
                );
            }
        }
        $database = NULL;
        return $msg;
    }
    public function delete_user($params)
    {
        global $config;
        $database = new PDO($config['dsn'],$config['user'],$config['pass']);
        $user_Id=$params['user_Id'];
        $password=$params['password'];
        $result = $database->query('SELECT * FROM user WHERE `user_Id` = "'.$user_Id.'" AND `user_password`="'.md5($password).'"');
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $row = $result->fetch();
        if((isset($row['user_name']) && isset($password)) OR ($params['isadmin']))
        {
            $result = $database->query('DELETE FROM user WHERE `user_Id` = "'.$user_Id.'"');
            $msg=array(
                'code'=>2,
                'msg'=>'Account has been deleted'
            );
        }
        else
        {
            $msg=array(
                'code'=>3,
                'msg'=>'Incorrect data'
            );
        }
        $database = NULL;
        return $msg;
    }
    public function field_test($field)
    {
        return $field;
    }
    public function check_permission($uid,$code)
    {
        global $config;
        $database = new PDO($config['dsn'],$config['user'],$config['pass']);
        $result=$database->query("SELECT `role_id` FROM `user` WHERE `uid`= '".$uid."'");
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $row = $result->fetch();
        $result2=$database->query("SELECT * FROM `permission` WHERE `role_id`='".$row['role_id']."' AND  `permission_code`='".$code."'");
        $row2 = $result2->fetch();
        if($row2){
            return true;
        }
        else {
            return false;
        }
    }
    public function activation($code)
    {
        global $config;
        $database = new PDO($config['dsn'],$config['user'],$config['pass']);
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
                $msg= array(
                    'code'=>1,
                    'msg'=>'Activated'
                );

            }
            else{$msg= array(
                'code'=>2,
                'msg' =>'You account already activated, you should not do this again.');}
        }
        else{$msg= array(
            'code'=>2,
            'msg' =>'Failed activation key.');}
        echo $msg;
        $database = NULL;
    }
    public function SendMail ($email, $login, $activation)
    {
        global $config;
        $database = new PDO($config['dsn'],$config['user'],$config['pass']);
        $res = $database->exec('INSERT INTO `activation` (user_Id, `hash`, `time`) VALUES (
                                    (SELECT `user_Id` FROM `user` WHERE `user_name` = "'.$login.'"),"'.$activation.'", "'.time().'")')
        or die(print_r($database->errorInfo(), true));
        $subject='linkstore.com account activation.';
        $body='Hello. Please, activate your account. http://linkstore.com/user/activation?code='.$activation.'</a>';
        $st=mail($email, $subject, $body);
        return $st;
    }
    public function CronDelete ()
    {
        global $config;
        $database = new PDO($config['dsn'],$config['user'],$config['pass']);
        global $activ_time;
        $deadline=time()-$activ_time;
        $database->exec("DELETE FROM `activation` WHERE `time`<='".$deadline."'");
    }
    public function get_id($uid)
    {
        global $config;
        $database = new PDO($config['dsn'],$config['user'],$config['pass']);
        $result=$database->query('SELECT `user_Id` FROM `user` WHERE `uid`="'.$uid.'"');
        $res=$result->fetch();
        return $res['user_Id'];
    }
    public function userlist($type,$start, $stop)
    {
        global $config;
        $database = new PDO($config['dsn'],$config['user'],$config['pass']);
        if ($type==1) {
            $sql ="SELECT * FROM `user` ORDER BY `user_Id` ASC LIMIT " . $start . " ," . $stop;
            $res = $database->query($sql);
            $res->setFetchMode(PDO::FETCH_ASSOC);
            $result = $res->fetchAll();
        }
        else{
            $res = $database->query("SELECT * FROM `user` ");
            $res->setFetchMode(PDO::FETCH_ASSOC);
            $result = $res->fetchAll();
        }
        return $result;
    }
    public function is_adm($uid)
    {
        global $config;
        $database = new PDO($config['dsn'],$config['user'],$config['pass']);
        $res=$database->query('SELECT * FROM `user` WHERE `uid`="'.$uid.'"');
        $res->setFetchMode(PDO::FETCH_ASSOC);
        $result = $res->fetch();
        if ($result['role_id']==1){$isadm=true;}else{$isadm=false;}
        return $isadm;
    }
    public function get_name($uid)
    {
        global $config;
        $database = new PDO($config['dsn'],$config['user'],$config['pass']);
        $result=$database->query('SELECT `user_name` FROM `user` WHERE `uid`="'.$uid.'"');
        $res=$result->fetch();
        return $res['user_name'];
    }
}