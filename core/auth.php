<?php

namespace App;


class Auth
{
    //Auth rulles
    /**
     * $var = array (  arrray('controller_name => Array(actions list));
     */
#Aloow for everybody

    public static $allow = array(
        'main' => array('index'),
        'users' => array('registration', 'index', 'login', 'logout')
    );

# Allow for authenticated users
    public static $allow_user = array(
        'main' => array('index'),
        'users' => array(
            'index',
            'logout',
            'view',
            'add',
            'edit' => ['param'],
            'delete' => ['param']
        )
    );


    public static function setAuth($data)
    {
        $_SESSION['user'] = $data;
    }

    public static function isAuth()
    {
        return isset($_SESSION['user']);
    }

    public static function getAuthUser()
    {
        return $_SESSION['user'];
    }

    public static function isAllowed($controller_name, $action, $param = null)
    {
//        pr($controller_name);
//        pr( $action);
//        pr($param);
        // is Auth ?
        if (!self::isAuth()) {
            //Check for none Auth users
            if (in_array($action, self::$allow[$controller_name])) {
                return true;
            }
            return false;
        }
        //Is admin ?
        $user = self::getAuthUser();
        if ($user['admin']) {
            return true;
        }
        //Check Auth user
        if (array_key_exists($action, self::$allow[$controller_name])) {
            return true;
        }
        if (in_array($action, self::$allow_user[$controller_name])) {
            return true;
        }
        if (array_key_exists($action, self::$allow_user[$controller_name])) {
            if ($user['id'] === $param[0]) {
                return true;
            }
        }
        return false;
    }

}