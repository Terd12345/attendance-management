<?php

class connection{

    private $hostname = 'localhost';
    private $username = 'root';
    private $password = '';
    private $dbname = 'attendance_management_mvc';


    protected function view(){
        $dsn = "mysql:host=" . $this->hostname . ";dbname=" . $this->dbname;
        $pdo = new PDO($dsn, $this->username, $this->password);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $pdo;
    }

}