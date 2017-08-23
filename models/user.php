<?php

namespace App;
require_once __DIR__ . "/../core/config.php";

class User
{

//    protected $users = ['user1', 'user2', 'user3'];

    public function all()
    {
        $sql = 'SELECT * FROM users;';
        $users = DB::getInstance()->querySql($sql);
        return $users;
    }

/*    public function first($id)
    {
        $sql = 'SELECT * FROM users WHERE id =' . $id;
        $users = DB::getInstance()->querySql($sql);
        pr($users);
        return $users;
    }*/

    public function destroy($id)
    {
        unset ($this->users[$id]);
    }

    public function getById($id)
    {
        $sql = 'SELECT * FROM users WHERE id = :id;';
        $data = ['id' => $id];
        $res = DB::getInstance()->executeWithParams($sql, $data, 'data');
//        pr($res);
        return $res;
    }

    public function getByName($name)
    {
        $sql = "SELECT * FROM users WHERE name= :name";
        $data = ['name' => $name];
        $res = DB::getInstance()->executeWithParams($sql, $data, 'data');
//        pr($res);
        return $res;
    }

    public function add($data)
    {
//        pr($data);
//        die();
        $name = $data['name'];
        $age = $data['age'];
        $description = $data['description'];
        $avatar_url = $data['avatar_url'];

//        $DBH = DB::getInstance();
        $sql = "INSERT INTO users (name, age, description, password) VALUES (:name, :age, :description, :password)";
        $res = DB::getInstance()->executeWithParams($sql, $data);
//        pr($res);
        return $res;
    }

}