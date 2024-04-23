<?php
require __DIR__."/../Model/UserModel.php";

class GuestController
{
    private UserModel $userModel;

    public function __construct()
    {
        //$this->userModel = new UserModel();
    }

    public function home(): void
    {
        //$users = $this->userModel->getUsers();
        require __DIR__ . '/../view/home.php';
    }
}
