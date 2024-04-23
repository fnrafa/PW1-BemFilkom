<?php
require __DIR__."/../Controller/GuestController.php";
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

    public function routes(): void
    {
        $routes = [
            '' => function () {
                $this->guestController->home();
            },
            'home' => function () {
                $this->guestController->home();
            },
        ];
        if (isset($routes[$this->req])) {
            call_user_func($routes[$this->req]);
        } else {
            $alertMessage = "Error, page not found";
            require_once __DIR__ . '/../view/error/error.php';
        }
    }
}







