<?php
class DatabaseAccess
{

  private $conn;

  public function __construct()
  {
    $this->conn = new DatabaseConnection();
    $this->conn = $this->conn->getConnection();
  }

  public function query($query, $paramType = null, $params = array())
  {
    if (mysqli_connect_errno()) {
      die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $this->conn->prepare($query);

    if ($paramType !== null) {
        if (!is_array($params)) {
            throw new InvalidArgumentException("Params must be an array.");
        }
        $stmt->bind_param($paramType, ...$params);
    }

    $runStmt = $stmt->execute();
    if (!$runStmt) {
      echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
    } else {
      $method = explode(' ', $query)[0];
      $result;
      switch (strtoupper($method)) {
        case "SELECT":
          $result = $stmt->get_result();
          //var_dump($result);
          //$row = $result->fetch_array(MYSQLI_ASSOC);
          //var_dump($row);
          //echo "$row[lastName]";
          return $result;
          break;
        case 'UPDATE':
        case "INSERT":
        case 'DELETE':
          $result = $stmt->affected_rows;
          break;
        default:
          throw new Exception("Unsupported query type: $method");
      }
      $stmt->close();
      //$this->conn->close();
      return $result;
    }
  }

  // 用于获取最后一次插入操作所生成的自增 ID
  public function getInsertId()
  {
    return mysqli_insert_id($this->conn);
  }

  public function __destruct()
  {
      if ($this->conn) {
          $this->conn->close();
      }
  }
}
