<?php
/**
 * Created by PhpStorm.
 * User: andrey
 * Date: 08.10.15
 * Time: 12:17
 */
class model_link extends model
{
    public function add_link($link,$description, $name, $type, $user)
    {
        global $config;
        $database = new PDO($config['dsn'],$config['user'],$config['pass']);

        if (!empty($link) AND !empty($description))
        {
            $res = $database->query("SELECT COUNT(*) as count FROM `link` WHERE `link_address`='.$link.'");
            $row = $res->fetch();
            if ($row['count']==0)
            {
                $res = $database->exec("INSERT INTO `link` (link_address, link_description, link_name, type, user_Id)
                                    VALUES ('".$link."','".$description."','".$name."','".$type."',(
                                    SELECT `user_Id` FROM `user` WHERE `uid` = '".$user."'))")
                or die(print_r($database->errorInfo(), true));
                $msg=array(
                    'code'=>1,
                    'msg'=>'You add this link'
                );
            }
            else
            {
                $msg=array(
                    'code'=>3,
                    'msg'=>'You already add this link'
                );
            }
        }
        else {
            $msg = array(
                'code' => 3,
                'msg' => 'How you did it?'
            );
        }
        $database = NULL;
        return $msg;
    }
    public function edit_link($name, $field, $link_id)
    {
        global $config;
        $database = new PDO($config['dsn'],$config['user'],$config['pass']);
        $res = $database->query("UPDATE `link` SET ".$name." = '".$field."' WHERE `link_id` = '".$link_id."'");
        $database = NULL;
    }
    public function delete_link($id)
    {
        global $config;
        $database = new PDO($config['dsn'],$config['user'],$config['pass']);
        $sql="DELETE FROM `link` WHERE `link_id`='".$id."'";
        $database->query($sql);
        $database = NULL;
    }

    public function show_link($type, $user,$start=0, $stop=1000)
    {
        global $config;
        $database = new PDO($config['dsn'],$config['user'],$config['pass']);
        if(($user != 1)AND ($user!=0))
        {
            if ($type==0)
            {
                $sql = "SELECT * FROM `link` WHERE `type`= 0 ORDER BY `link_id` ASC LIMIT " .$start. ",". $stop;
                $res = $database->query($sql);
                $res->setFetchMode(PDO::FETCH_ASSOC);
                $result=$res->fetchAll();

            }
            else
            {
                $res = $database->query("SELECT * FROM `link` WHERE `user_Id` = (
                                        SELECT `user_Id` FROM `user` WHERE `uid` = '".$user."')
                                        ORDER BY `link_id` DESC LIMIT ".$start." ,". $stop);
                $res->setFetchMode(PDO::FETCH_ASSOC);
                $result=$res->fetchAll();
            }
        }
        elseif($user==1)
        {
            $res=$database->query("SELECT * FROM `link` WHERE `type`='".$type."'ORDER BY `link_id` DESC LIMIT ".$start." ,". $stop );
            $res->setFetchMode(PDO::FETCH_ASSOC);
            $result=$res->fetchAll();
        }
        else
        {
            $res=$database->query("SELECT * FROM `link` ORDER BY `link_id` DESC LIMIT ".$start." ,". $stop);
            $res->setFetchMode(PDO::FETCH_ASSOC);
            $result=$res->fetchAll();
        }
        $database = NULL;
        return $result;
    }
}