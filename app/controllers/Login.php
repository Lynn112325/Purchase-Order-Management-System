<?php
declare(strict_types = 1);
// namespace app\controllers;
// use DatabaseAccess;

class Login extends Controller
{

  private $database;

  public function __construct()
  {
    $this->login();
  }

  public function login()
  {
    $database = new DatabaseAccess();
    error_log("try login");

    // 防止直接访问：通过检查请求方法，可以防止用户直接访问页面而不通过表单提交，从而提高安全性。
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

      $userId = $_POST['userId'];
      $password = $_POST['password'];
      $role = $_POST['role'];
      $username = '';

      if ($role === "supplier") {
        // Login supplier
        $result = $database->query("SELECT * FROM supplier WHERE supplierId = ? AND password = ?", "ss", array($userId, $password));
        $row = $result->fetch_array(MYSQLI_ASSOC);
        // var_dump($row);
        $username = $row['companyName'];
      } else if ($role === "pm") {
        // Login pm
        $result = $database->query("SELECT * FROM purchasemanager WHERE	purchaseManagerID = ? AND password = ?", "ss", array($userId, $password));
        $row = $result->fetch_array(MYSQLI_ASSOC);
        // var_dump($row);
        $username = $row['managerName'];
      } else {
        echo "Invalid role";
        exit;
      }
      // if login successfully
      if ($result->num_rows == 1) {
        session_start();
        $_SESSION['userId'] = $userId;
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $role;
        header("Location: /centralizedProcurementSystem/home");
      } else {
        header("Location: index?userId=$userId");
      }

    }
  }
}
