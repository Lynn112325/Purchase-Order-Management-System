<?php

declare(strict_types=1);
// Define the base URL for the application
define('BASE_URL', '/centralizedProcurementSystem/');
// error_log("Request URI: " . $_SERVER['REQUEST_URI']);

// Set session cookie parameters for security
ini_set('session.cookie_httponly', 1);
ini_set('session.cookie_secure', 1);

session_start();
// Set a custom session name
session_regenerate_id(true);


// Check if the session is valid
function sessionChecking()
{
  if (!isset($_SESSION['userId'])) {
    $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI']; // Store the requested URL
    header("Location: " . BASE_URL . "index");
    exit;
  }
}

function checkRole()
{
  if ($_SESSION['role'] === 'pm') {
    return "PM/";
  } elseif ($_SESSION['role'] === 'supplier') {
    return "Supplier/";
  } else {
    return "RoleError/";
  }
}

Route::group(BASE_URL, function () {


  Route::map('POST', 'login', function () {
    // instance of Login controller and call its render method to display the page
    (new Login())->render();
  });

  Route::map('GET', 'index', function () {
    // instance of Index controller and call its render method to display the page
    // If the user is logged in, redirect to the home page
    if (isset($_SESSION['username'])) {
      header("Location: " . BASE_URL . "home");
      exit;
    }
    (new Index())->render();
  });

  Route::map('GET', 'logout', function () {
    (new Logout())->render();
  });

  Route::group('', function () {

    if (!isset($_SESSION['userId'])) {
      // If the user is not logged in, redirect to the login page
      return;
    } else {
      sessionChecking();
    }
    Route::map('GET', 'home', function () {
      (new Home())->render(checkRole());
    });

    Route::map('GET', 'inventory/{restaurantId}', 'ViewInventory@getInventoryList');

    Route::map('GET', 'MakeOrder', function () {
      (new MakeOrder())->render(checkRole());
    });

    Route::map('GET', 'profile', function () {
    });

    Route::map('GET', 'orderhistory', function () {
    });
  });
});

Route::dispatch();
