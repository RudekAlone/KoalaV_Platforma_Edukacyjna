<?php
session_start();
## Login
require_once 'Models/UserModel.php';
require_once 'Views/Auth/LoginView.php';
require_once 'Controllers/LoginController.php';
## Register
require_once 'Views/Auth/RegisterView.php';
require_once 'Controllers/RegisterController.php';
## Errors
require_once 'Controllers/ErrorsController.php';
## Articles
require_once 'Models/ArticleModel.php';
require_once 'Views/CMS/ArticleView.php';
require_once 'Controllers/ArticleController.php';

/* ##############################
   Połączenie z bazą danych MySQL
  ################################*/
$db = new mysqli("localhost", "root", "", "edu_platform");

/* #########################
   Tworzenie obiektów modeli
  ###########################*/
$modelUser = new UserModel($db);
$modelArticle = new ArticleModel($db);

/* #######################################################
   Przechwycenie części adresu URL (www.domena.pl [/dane])
  #########################################################*/
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);



if (isset($_SESSION['user'])) {
  /* ###################################################
     Wykonaj przekierowania dla zalogowanego użytkownika
  ########################################################*/
  if ($uri === '/Logowanie' or $uri === '/Rejestracja' or $uri === '/') {
    echo "Dashboard"; // TODO: Dashboard
  } else if ($uri === '/LOGOUT') {
    $view = new LoginView();
    $controller = new LoginController($modelUser, $view);
    $controller->logout();
  } else if ($uri === '/create-article') {
    $view = new ArticleView();
    $controller = new ArticleController($modelArticle, $view);
    $controller->createArticle();
  } else if (preg_match('/^\/Lekcje\/(.*)$/', $uri, $matches)) {
    echo  "elo";
    $view = new ArticleView();
    $controller = new ArticleController($modelArticle, $view);
    $controller->displayArticle($matches[1]);
    echo $matches[1];
  } else {
    http_response_code(404);
  }
} else {
  /* #######################################################
     Wykonaj przekierowania dla NIE zalogowanego użytkownika
  #############################################################*/
  switch ($uri) {
    case '/':
      echo "TODO Home Page"; // TODO: Home Page
      break;
    case '/Logowanie':
      $view = new LoginView();
      $controller = new LoginController($modelUser, $view);
      $controller->login();
      break;
    case '/Rejestracja':
      $view = new RegisterView();
      $controller = new RegisterController($modelUser, $view);
      $controller->register();
      break;
    default:
      http_response_code(401);
      break;
  }
}




switch (http_response_code()) {
  case 401:
    handle_401_error();
    break;
  case 404:
    handle_404_error();
    break;
  case 500:
    handle_500_error();
    break;
}

// Włącz raportowanie błędów
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Funkcja do obsługi błędów 401
function handle_401_error()
{
  header('HTTP/1.1 401 Unauthorized');
  echo 'Nie masz uprawnień do wyświetlenia tej strony.';
  exit;
}

// Funkcja do obsługi błędów 404
function handle_404_error()
{
  header('HTTP/1.1 404 Not Found');
  $view = new ErrorView();
  $controller = new ErrorsController($view);
  $controller->error(404);
  exit;
}

// Funkcja do obsługi błędów 500
function handle_500_error()
{
  header('HTTP/1.1 500 Internal Server Error');
  echo 'Wystąpił błąd serwera.';
  exit;
}
