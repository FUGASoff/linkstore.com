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
        echo'lol1';
        if (!empty($link) AND !empty($description))
        {
            $res = $database->exec('INSERT INTO `link` (link_address, link_description, link_name, type, user_Id)
                                    VALUES ("'.$link.'","'.$description.'","'.$name.'","'.$type.'",(
                                    SELECT `user_Id` FROM `user` WHERE `user_name` = "'.$user.'"))')
            or die(print_r($database->errorInfo(), true));
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

    public function show_link($type, $user)
    {
        global $config;
        $database = new PDO($config['dsn'],$config['user'],$config['pass']);
        if ($type==0)
        {
            $res = $database->query('SELECT * FROM `link` WHERE `type` = 0');
            $res->setFetchMode(PDO::FETCH_ASSOC);
            $result=$res->fetchAll();
        }
        else
        {
            $res = $database->query('SELECT * FROM `link` WHERE `type` = 1 AND `user_Id` = (
                                    SELECT `user_Id` FROM `user` WHERE `user_name` = "'.$user.'")');
            $res->setFetchMode(PDO::FETCH_ASSOC);
            $result=$res->fetchAll();
        }
        $database = NULL;
        return $result;
    }
}