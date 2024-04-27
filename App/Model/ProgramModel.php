<?php

class ProgramModel
{
    public PDO $conn;

    public function __construct()
    {
        $conn = new Database();
        $this->conn = $conn->getConn();
    }

    public function getPrograms(): bool|array
    {
        $stmt = $this->conn->query('SELECT * FROM programs');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
