<?php
require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../utils/Validator.php';

class Employee {
    private $conn;
    private $table = 'employees';

    // 员工属性
    public $id;
    public $first_name;
    public $last_name;
    public $email;
    public $phone;
    public $position;
    public $hire_date;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    /**
     * 创建新员工
     */
    public function create() {
        $query = "INSERT INTO " . $this->table . "
                (first_name, last_name, email, phone, position, hire_date)
                VALUES (:first_name, :last_name, :email, :phone, :position, :hire_date)";

        $stmt = $this->conn->prepare($query);

        // 清理数据
        $this->first_name = Validator::sanitize($this->first_name);
        $this->last_name = Validator::sanitize($this->last_name);
        $this->email = Validator::sanitize($this->email);
        $this->phone = Validator::sanitize($this->phone);
        $this->position = Validator::sanitize($this->position);

        // 绑定参数
        $stmt->bindParam(':first_name', $this->first_name);
        $stmt->bindParam(':last_name', $this->last_name);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':phone', $this->phone);
        $stmt->bindParam(':position', $this->position);
        $stmt->bindParam(':hire_date', $this->hire_date);

        return $stmt->execute();
    }

    /**
     * 获取所有员工
     */
    public function read() {
        $query = "SELECT * FROM " . $this->table . " ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    /**
     * 获取单个员工信息
     */
    public function readOne() {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
        return $stmt;
    }

    /**
     * 删除员工
     */
    public function delete() {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);
        return $stmt->execute();
    }
}