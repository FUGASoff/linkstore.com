<?php
/**
 * Created by PhpStorm.
 * User: andrey
 * Date: 08.10.15
 * Time: 12:06
 */
class Route
{
    static function start()
    {
        $url = $_GET['url'];
        $url = rtrim($url, '/');
        $url = explode('/', $url);
        $file = '../controller/'.$url[0].'.php';
        if(file_exists($file)) {
            require $file;
        } else {
            require '../controller/error.php';
            $controller = new Error();
            return false;
        }
        $controller = new $url[0];
        if(isset($url[2])) {
            $controller->$url[1]($url[2]);
        } else {
            if(isset($url[1])) {
                $controller->$url[1]();
            }
        }

    }
}