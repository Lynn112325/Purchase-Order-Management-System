<?php
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
      } else {
        // Login pm
        $result = $database->query("SELECT * FROM purchasemanager WHERE	purchaseManagerID = ? AND password = ?", "ss", array($userId, $password));
        $row = $result->fetch_array(MYSQLI_ASSOC);
        // var_dump($row);
        $username = $row['managerName'];
      }

      // if login successfully
      if ($result->num_rows == 1) {

        session_start();
        $_SESSION['userId'] = $userId;
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $role;
        header("Location: home");
      } else {
        header("Location: index?userId=$userId");
      }

    }
  }
}
