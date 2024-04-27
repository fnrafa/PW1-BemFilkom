<?php

class Database
{
    private PDO $conn;

    public function __construct()
    {
        $this->startConnection();
    }

    public function startConnection(): void
    {
        try {
            $sqlHost = config("DB_HOST");
            $sqlUser = config('DB_USERNAME');
            $sqlPass = config('DB_PASSWORD');
            $sqlName = config('DB_NAME');

            $this->conn = new PDO("mysql:host=$sqlHost;dbname=$sqlName", $sqlUser, $sqlPass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            loadView('error.error', $e);
        }
    }

    public function getConn(): PDO
    {
        return $this->conn;
    }
}