<?php
namespace App;


class Auth{

    public static function setAuth($data){
        $_SESSION['user'] = $data;
    }

    public static function isAuth(){
        return  isset($_SESSION['user']);
    }

    public static function getAuthUser(){

    }
}