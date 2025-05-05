<?php

class Database
{
  private $engine = "mysql";
  private $hostname = "localhost";
  private $username = "root";
  private $password = "";
  private $database = "drive_ease";
  protected $conn;

  function __construct()
  {
    try {
      $this->connect();
    } catch (Exception $err) {
      var_dump($err);
    }
  }

  function connect()
  {
    $this->conn = new PDO("$this->engine: host=$this->hostname;dbname=$this->database;", $this->username, $this->password);
  }

}

?>