<?php
require_once __DIR__ . '/../Models/UserModel.php';

require_once __DIR__ . '/../Views/Errors/ErrorView.php';

class ErrorsController
{
    private $view;

    public function __construct($view)
    {
        $this->view = $view;
    }

    public function error($code)
    {
        switch ($code) {
            case 401:
                $this->view->render('401.html');
                break;
            case 404:
                $this->view->render('404.html');
                break;
            case 500:
                $this->view->render('500.html');
                break;
            default:
                $this->view->render('404.html');
                break;
        }
    }
}
