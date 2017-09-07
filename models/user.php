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

    public function delete($id)
    {
       $id = intval($id);
       $sql = 'DELETE FROM users WHERE id = :id' ;
        $data = ['id' => $id];
        $res = DB::getInstance()->executeWithParams($sql, $data);
//        pr($res);

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
//        $DBH = DB::getInstance();
        $data = $this->__stripData($data);
        $sql = "INSERT INTO users (name, age, description, password) VALUES (:name, :age, :description, :password)";
        $res = DB::getInstance()->executeWithParams($sql, $data);
//        pr($res);
        return $res;
    }

    public function update($data)
    {
        $data = $this->__stripData($data);
//        $DBH = DB::getInstance();
        $sql = "UPDATE users 
            SET name = :name,
            age = :age,
            description = :description,
            password = :password,
            avatar_url = :avatar_url
            WHERE id = :id";
//            avatar_url = IF(trim(:avatar_url)=\"\", avatar_url, :avatar_url)
        $res = DB::getInstance()->executeWithParams($sql, $data);
//        pr($res);
        return $res;
    }

    private function __stripData($data)
    {
        foreach ($data as $k => $v) {
            $data[$k] = strip_tags($v);
        }
        return $data;
    }
}