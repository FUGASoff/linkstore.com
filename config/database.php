<?php
/**
 * Created by PhpStorm.
 * User: andrey
 * Date: 09.10.15
 * Time: 15:49
 */
class Database extends PDO
{
    public function __construct(){
        $this->engine = 'mysql';
        $this->host = 'localhost';
        $this->database = 'linkstore';
        $this->user = 'root';
        $this->pass = 2486;

        $db = new PDO('mysql:host=localhost;dbname=test', $this->user, $this->pass );
        return $db;
    }
}