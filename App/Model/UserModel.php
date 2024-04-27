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

    public function validateUser($nim, $password)
    {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE nim = :nim");
        $stmt->bindParam(':nim', $nim);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        } else {
            return null;
        }
    }


    public function registerUser($name, $nim, $password, $batch): bool
    {
        try {
            $uuid = generateUUID();
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            $stmt = $this->conn->prepare("INSERT INTO users (id, name, nim, password, batch, position) VALUES (:id, :name, :nim, :password, :batch, 'Member')");
            $stmt->bindParam(':id', $uuid);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':nim', $nim, PDO::PARAM_STR);
            $stmt->bindParam(':password', $hashedPassword, PDO::PARAM_STR);
            $stmt->bindParam(':batch', $batch, PDO::PARAM_INT);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException) {
        }
    }
}
