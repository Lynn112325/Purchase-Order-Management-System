<?php
class View {

  public static function render($viewName, $viewData = null){
    require_once("./app/views/$viewName.php");
  }
  
}
?>
