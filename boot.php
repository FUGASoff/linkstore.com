<?php
class Boot
{
    public function __construct()
    {
        $url = isset($_GET['url']) ? $_GET['url'] : null;
        if(empty($url[0])) {
            require 'controller/index.php';
            $controller = new Index();
            return false;
        }
        $url = rtrim($url, '/');
        $url = explode('/', $url);
        $file = 'controller/' . $url[0] . '.php';
        if (file_exists($file)) {
            require $file;
        } else {
            require 'controller/error.php';
            $controller = new Error();
            return false;
        }
        $controller = new $url[0];
        if (isset($url[2])) {
            $controller->$url[1]($url[2]);
        } else {
            if (isset($url[1])) {
                $controller->$url[1]();
            }
        }
    }
}