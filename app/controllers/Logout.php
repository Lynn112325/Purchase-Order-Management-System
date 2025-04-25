<?php
class Logout extends Controller
{

  function __construct()
  {
    session_destroy();
    error_log("logout successfully");
    header('Location: ./app/views/index');
  }
}