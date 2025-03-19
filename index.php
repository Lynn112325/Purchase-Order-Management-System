<?php
// 使用 spl_autoload_register 函数注册一个自动加载函数
// 这个函数会在尝试使用一个未定义的类时被调用
spl_autoload_register(function ($class_name) {
    if (file_exists('classes/' . $class_name . '.php')) {
        require_once('./classes/' . $class_name . '.php');
    } else if (file_exists('controllers/' . $class_name . '.php')) {
        require_once('./controllers/' . $class_name . '.php');
    } else if (file_exists('models/' . $class_name . '.php')) {
        require_once('./models/' . $class_name . '.php');
    }
});

require_once("routers/Routers.php");
