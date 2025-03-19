<?php
  // 啟動會話
  session_start();

  // 檢查用戶的會話是否有效
  function sessionChecking(){
    if(!isset($_SESSION['username']) || !isset($_SESSION['role']))
      
      header("location: index");
  }

  function checkRole() {
      if ($_SESSION['role'] === 'pm') {
          return "PM/";
      } elseif ($_SESSION['role'] === 'supplier') {
          return "Supplier/";
      } else {
          return "RoleError/";
      }
  }

  Route::map('login', function(){
    $controller = new Login();
  });

  Route::map('index', function(){
    // 實例化 Index 控制器並調用其 render 方法來顯示頁面
    $controller = new Index();
    $controller->render();
  });

  Route::map('home', function(){
    // 首先檢查會話（確保用戶已登錄）
    sessionChecking();
    // 實例化 Home 控制器並調用其 render 方法來顯示頁面
    $controller = new Home();
    $controller->render(checkRole());
  });

  Route::map('MakeOrder', function(){
    // 首先檢查會話（確保用戶已登錄）
    sessionChecking();
    // 實例化 MakeOrder 控制器並調用其 render 方法來顯示頁面
    $controller = new MakeOrder();
    $controller->render(checkRole());
  });

  Route::map('profile', function(){
    // 首先檢查會話（確保用戶已登錄）
    sessionChecking();
    // 實例化 Profile 控制器並調用其 render 方法來顯示頁面
    $controller = new Profile();
    $controller->render(checkRole());
  });

  Route::map('orderhistory', function(){
    sessionChecking();
    $controller = new OrderHistory();
    $controller->render(checkRole());
  });

  Route::map('logout', function(){
    $controller = new Logout();
  });

  Route::map('store', function(){
    sessionChecking();
    $controller = new Store();
    $controller->render();
  });

  Route::map('cart', function(){
    sessionChecking();
    // if 購物車不為空
    if(isset($_SESSION["store"]) && isset($_SESSION["products"])){
      $controller = new Cart();
      $controller->render();
    }else{
    // if 購物車為空
      header("location: home");
    }
  });

  Route::map('addToCart', function(){
    $controller = new AddToCart();
  });

  Route::map('removeInCart', function(){
    sessionChecking();
    $controller = new RemoveInCart();
  });

  Route::map('checkout', function(){
    sessionChecking();
    $controller = new CheckOut();
  });

  Route::map('viewCart', function(){
    sessionChecking();
    $controller = new ViewCart();
  });

  Route::map('checking', function(){
    sessionChecking();
    $controller = new Checking();
  });


?>
