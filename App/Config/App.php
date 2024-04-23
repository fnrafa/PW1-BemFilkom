<?php
require __DIR__ . "/config.php";
require __DIR__ . "/database.php";
require __DIR__ . "/../Route/route.php";

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
        //new Database();
        new Route($this->req);
    }
}