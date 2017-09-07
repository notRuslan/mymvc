<?php

namespace App;

//define('PATH_TO_SQLITE_FILE', 'db/burger.db'); see config.php
class  DB
{
    private static $_instatnce;
    private $_conn;


    #Private

    private function __construct()
    {
        $dsn = "sqlite:" . PATH_TO_SQLITE_FILE;
//        print_r(PDO::getAvailableDrivers());
        $this->_conn = new \PDO($dsn, 'user', 'password');
        //Live mode
//            $this->_conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_SILENT);
        //Devepoping mode
        $this->_conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_WARNING);
//        $this->_conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    public function getInstance()
    {
        if (empty(self::$_instatnce)) {
            self::$_instatnce = new self();
        }
        return self::$_instatnce;
    }

    public function querySql($sql)
    {
        $result = $this->_conn->query($sql);
        return $result->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * @param string $query
     * @param array $params
     * @return int
     * @throws Exception
     */
// Usage
    /*$query = 'UPDATE table1 SET col1 = :input1 WHERE id = :id';

    $params = array(
    ':input1' => 'dynamic param binding works',
    ':id' => 5);
    $affectedRows = executeWithParams($query, $params);
    */
    public function executeWithParams($query, $params, $rowOrData = 0)
    {
        if (empty($query)) {
            throw new Exception('SQL statement is missing.');
        } else if (!is_array($params)) {
            throw new Exception('Params is not an array');
        }
//        pr($params);

//        pr($query);
        $stm = $this->_conn->prepare($query);
        if (!$stm) {
            echo "\PDO::errorInfo():\n";
            pr($this->_conn->errorInfo());
        }
        foreach ($params as $param => &$value) {
//            $val = ($value) ? $value : null;
            $stm->bindParam( $param, $value);
//            $stm->bindParam(':' . $param, $value);
        }
//pr($stm->debugDumpParams());
        $stm->execute();
        if (!$rowOrData) {
            return $stm->rowCount();
        } else {
            return $stm->fetch(\PDO::FETCH_ASSOC);
        }
    }

#Private
    private function __clone()
    {
    }

    private function __wakeup()
    {
    }


}