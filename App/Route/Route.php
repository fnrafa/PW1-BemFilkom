<?php
require __DIR__ . "/../Controller/GuestController.php";

class Route
{
    private string $req;
    private GuestController $guestController;

    public function __construct($req)
    {
        $this->req = $req;
        $this->guestController = new GuestController();
        $this->routes();
    }

    private function authorize(array $requiredRoles = []): void
    {
        if (!isset($_COOKIE['auth_token']) || !Authentication::verifyToken($_COOKIE['auth_token'])) {
            loadView('Error.error', "Unauthorized Access");
        }
        if (!empty($requiredRoles) && !Authorization::hasAnyRole($_COOKIE['auth_token'], $requiredRoles)) {
            loadView('Error.error', "Access Denied");
        }
    }

    public function routes(): void
    {
        $getRoutes = [
            '' => function () {
                loadView('home');
            },
            'home' => function () {
                loadView('home');
            },
            'login' => function () {
                loadView('login');
            },
            'register' => function () {
                loadView('register');
            },
            'program' => function () {
                $this->authorize(['Leader', 'Member']);
                loadView('program');
            },
        ];

        $postRoutes = [
            'login' => function () {
                $this->guestController->login($_POST['nim'], $_POST['password']);
            },
            'register' => function () {
                $this->guestController->register($_POST['name'], $_POST['nim'], $_POST['password'], $_POST['batch']);
            },
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($postRoutes[$this->req])) {
            call_user_func($postRoutes[$this->req]);
        } elseif ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($getRoutes[$this->req])) {
            call_user_func($getRoutes[$this->req]);
        } elseif (isset($getRoutes[$this->req])) {
            call_user_func($getRoutes[$this->req]);
        } else {
            loadView('Error.error', "404 Not Found");
        }
    }
}





