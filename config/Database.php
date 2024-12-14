<?php
class Database {
    private $conn;
    private $config;

    public function __construct() {
        $this->config = require_once 'config.php';
    }

    public function connect() {
        try {
            $this->conn = new PDO(
                "mysql:host=" . $this->config['db']['host'] . 
                ";dbname=" . $this->config['db']['database'],
                $this->config['db']['username'],
                $this->config['db']['password']
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->conn;
        } catch(PDOException $e) {
            echo "数据库连接错误: " . $e->getMessage();
            return null;
        }
    }
}