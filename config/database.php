<?php
/**
 * Created by PhpStorm.
 * User: andrey
 * Date: 09.10.15
 * Time: 15:49
 */
class Database extends mysqli
{
    private $hostname;
    private $username;
    private $password;
    private $database;
    public function __construct()
    {
        // Initialize object with database constants
        $this->hostname = 'localhost';
        $this->username = 'root';
        $this->password = 2486;
        $this->database = 'inkstore';

        // Open database connection
        parent::__construct(
            $this->hostname,
            $this->username,
            $this->password,
            $this->database
        );
    }
}