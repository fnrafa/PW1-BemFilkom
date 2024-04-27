<?php
require __DIR__ . "/../Model/UserModel.php";

class GuestController
{
    private UserModel $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function login($nim, $password): void
    {
        $user = $this->userModel->validateUser($nim, $password);
        if ($user) {
            $token = Authentication::generateToken($user);
            setcookie('name', $user['name']);
            setcookie('auth_token', $token, time() + 3600, '/');
            viewRoute('home');
        } else {
            loadView('Error.error', "Invalid Password or Name");
        }
    }

    public function register($name, $nim, $password, $batch): void
    {
        $register = $this->userModel->registerUser($name, $nim, $password, $batch);
        if ($register) {
            viewRoute('login');
        } else {
            loadView('Error.error', "Invalid Password or Name");
        }
    }
}
