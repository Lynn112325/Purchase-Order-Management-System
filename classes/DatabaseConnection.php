<?php
class DatabaseConnection
{

  private $hostname;
  private $database;
  private $username;
  private $password;
  public function __construct()
  {
    $this->hostname = "127.0.0.1";
    $this->database = "procurementsystem";
    $this->username = "root";
    $this->password = "";
  }

  public function getConnection()
  {
    $conn = mysqli_connect($this->hostname, $this->username, $this->password, $this->database);
    // 檢查連接
    if ($conn->connect_error) {
      die("connect_error: " . $conn->connect_error);
    }
    return $conn;
  }
}
