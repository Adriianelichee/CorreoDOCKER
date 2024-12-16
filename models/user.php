<?php
class User {
    private $conn;
    private $table_name = "users";

    public $id;
    public $email;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read() {
        $query = "SELECT id, email FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET email=:email";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":email", $this->email);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }
}