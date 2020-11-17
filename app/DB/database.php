<?php

require_once(__DIR__."./config/config.php");

class Database {
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PWD;
    private $dbName = DB_BNAME; 

    private $connection;
    private $error;
    private $stmt;
    private $dbConnected = false;

    public function __construct() {
        $dsn = "mysql:host={$this->host};dbname={$this->dbName}";
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );

        try {
            $this->connection = new PDO($dsn, $this->user, $this->pass, $options);
            $this->dbConnected = true;
        }
        catch(PDOException $e) {
            $this->error = $e->getMessage();
            $this->dbConnected = false;
        }
    }

    public function getError() {
        return $this->error;
    }

    public function isConnected() {
        return $this->dbConnected;
    }

    public function query($query) {
        $this->stmt = $this->connection->prepare($query);
    }

    public function execute() {
        return $this->stmt->execute();
    }

    public function resultSet() {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function rowCount() {
        return $this->stmt->rowCount();
    }

    public function single() {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    public function bind($param, $value, $type = null) {
        if(is_null($type)) {
            switch(true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }

        $this->stmt->bindValue($param, $value, $type);
    }
}