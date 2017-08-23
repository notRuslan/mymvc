<?php
require_once 'core/config.php';
//require_once __DIR__ ."/core/config.php"; ????
require_once 'core/db.php';
require_once 'core/view.php';
require_once 'core/message.php';
require_once 'core/auth.php';
session_start();
$sID = session_id();
$controller_name = "Main";  //defaulr name
$action_name = 'index';     //defaulr name
//pr($_SERVER['SERVER_NAME']);
//pr($sID);
$routes = explode('/', $_SERVER['REQUEST_URI']);
$param_quantity = count($routes) - 3;
//pr($param_quantity);
//pr($routes);
if (!empty($routes[1])) {
    $controller_name = $routes[1];
}

if (!empty($routes[2])) {
    $action_name = $routes[2];
}
$filename = 'controllers/' . strtolower($controller_name) . '.php';
try {
    if (file_exists($filename)) {
        require_once $filename;
    } else {
        throw  new  Exception("Controller not found");
    }

    $classname = 'App\\' . ucfirst(strtolower($controller_name));
    if (class_exists($classname)) {
        $controller = new $classname;
    } else {
        throw new Exception("File found, class {$classname} not found");
    }

    if (method_exists($controller, $action_name)) {
        $ref = new ReflectionClass($classname);
        $param_quantity_requerie = $ref->getMethod($action_name)->getNumberOfParameters();
        if ($param_quantity_requerie > $param_quantity) {
            throw new Exception('Missed parameter');
        }

        call_user_func_array([$controller, $action_name], array_slice($routes, 3));
//        $controller->$action_name(1,2,3);
    } else {
        throw new Exception('Method not found');
    }


} catch (Exception $e) {
    require "errors/404.php";
}



//    echo App\Message::getMessage();
//session_destroy();
function pr($str)
{
    $bt = debug_backtrace();
    $caller = array_shift($bt);
echo "-----------------------------------------<br>";
    echo $caller['file'] . ' ' .$caller['line'];
    echo '<pre>';
//    print_r($str);
    var_dump($str);
    echo '</pre>';
echo "-----------------------------------------<br>";
}