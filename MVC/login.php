<?
// Model
class UserModel
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getUser($username, $password)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username=? AND password=?");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
}

// View
class LoginView
{
    public function render()
    {
        echo <<<HTML
        <form method="POST" action="/login">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        HTML;
    }
}

// Controller
class LoginController
{
    private $model;
    private $view;

    public function __construct($model, $view)
    {
        $this->model = $model;
        $this->view = $view;
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = $this->model->getUser($_POST['username'], $_POST['password']);
            if ($user) {
                session_start();
                $_SESSION['user'] = $user;
                header('Location: /dashboard');
                exit();
            } else {
                echo "Invalid username or password.";
            }
        } else {
            $this->view->render();
        }
    }
}

// Usage
$db = new mysqli("localhost", "username", "password", "database");
$model = new UserModel($db);
$view = new LoginView();
$controller = new LoginController($model, $view);
$controller->login();
