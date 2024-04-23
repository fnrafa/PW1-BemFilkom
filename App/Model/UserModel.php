<?php

class UserModel
{
    public PDO $conn;

    public function __construct()
    {
        $conn = new Database();
        $this->conn = $conn->getConn();
    }

    public function getUsers(): bool|array
    {
        $stmt = $this->conn->query('SELECT * FROM users');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
