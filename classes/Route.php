<?php
class Route {

  // 這行代碼定義了一個靜態屬性 $routes，用來存儲所有的路由映射
  // 因為它是靜態的，所以可以通過類名直接訪問（例如 Route::$routes）
  public static $routes = array();

  // map 方法接受兩個參數：$route（要映射的路由）和 $function（對應的處理函數）***
  // 主要功能是將路由和相應的處理函數進行關聯
  public static function map($route, $function){
    // 將傳入的 $route 添加到 $routes 的數組中，這樣以後可以查詢到所有已定義的路由
    self::$routes[] = $route;
    // 輸出目前已定義的所有路由
    // print_r(self::$routes);

    if($_GET['url'] == $route){
      $function->__invoke();
      // 如果請求的 URL 與當前的 $route 匹配，則調用傳入的函數
      // 使用 __invoke() 方法，這意味著 $function 需要是一個可以被調用的對象
      // （例如實現了 __invoke 方法的對象）或一個可調用的閉包（匿名函數）
    }
  }
}
?>
