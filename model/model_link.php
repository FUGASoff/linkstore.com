<?php
/**
 * Created by PhpStorm.
 * User: andrey
 * Date: 08.10.15
 * Time: 12:17
 */
class model_link extends model
{
    public function add_link($link,$description, $name, $type,$user)
    {
        global $config;
        $database = new PDO($config['dsn'],$config['user'],$config['pass']);
        if (!empty($link) AND !empty($discription))
        {
            $res = $database->exec('INSERT INTO `link` (link_address, link_description, link_name, type) VALUES ("'.$link.'","'.$description.'","'.$name.'","'.$type.'")')
            or die(print_r($database->errorInfo(), true));
            $res = $database->query("SELECT `user_Id` FROM `user` WHERE `user_name` = '.$user.'");
            $res->setFetchMode(PDO::FETCH_ASSOC);
            $userid = $res->fetch();
            $database->exec('INSERT INTO `store`(user_id,link_id) VALUES('.$userid.',(SELECT LAST_INSERT_ID(user_Id) FROM user))');
        }
        $database = NULL;
    }
    public function edit_link($link,$description, $name, $type)
    {
        global $config;
        $database = new PDO($config['dsn'],$config['user'],$config['pass']);

        $database = NULL;
    }
    public function delete_link()
    {
        global $config;
        $database = new PDO($config['dsn'],$config['user'],$config['pass']);

        $database = NULL;
    }
}