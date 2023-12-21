<?php
require_once __DIR__ .  '/../Models/UserModel.php';
require_once __DIR__ . '/../Views/Auth/RegisterView.php';

class RegisterController
{
    private $model;
    private $view;

    public function __construct($model, $view)
    {
        $this->model = $model;
        $this->view = $view;
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $email = $_POST['email'];

            $user = $this->model->getUserByUsername($username);
            if ($user) {
                $this->view->render("Username already exists.");
                return;
            }

            $user = $this->model->getUserByEmail($email);
            if ($user) {
                $this->view->render("Email already exists.");
                return;
            }

            $this->model->createUser($username, $password, $email);
            $this->view->render("User created successfully.");
        } else {
            $this->view->render();
        }
    }
}
