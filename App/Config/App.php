<?php
require __DIR__ . "/config.php";
require __DIR__ . "/database.php";
require __DIR__ . "/View.php";
require __DIR__ . "/../Route/route.php";
require __DIR__ . "/../Middleware/Authentication.php";
require __DIR__ . "/../Middleware/Authorization.php";

class App
{
    private string $req;

    public function __construct()
    {
        $this->req = trim($_SERVER['REQUEST_URI'], '/');
        $this->start();
    }

    public function start(): void
    {
        new Config();
        new View();
        new Database();
        new Route($this->req);
    }
}