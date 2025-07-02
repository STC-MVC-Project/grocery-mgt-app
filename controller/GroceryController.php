<?php
require_once './model/Grocery.php';
require_once './auth.php'; // +
require_once './lib/flash.php'; // +

class GroceryController {
    private $model;

    public function __construct() {
        $this->model = new Grocery();
    }

    public function handleRequest() {
        $action = $_GET['action'] ?? 'dashboard';

        switch ($action) {
            case 'add':
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $name = $_POST['name'];
                    $quantity = $_POST['quantity'];
                    if ($name && $quantity) {
                        $this->model->addGrocery($name, $quantity);
                        header('Location: index.php');
                    } else {
                        $error = 'All fields required';
                        include './view/add.php';
                    }
                } else {
                    include './view/add.php';
                }
                break;

            case 'edit':
                $id = $_GET['id'];
                $item = $this->model->getGroceryById($id);
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $name = $_POST['name'];
                    $quantity = $_POST['quantity'];
                    $this->model->updateGrocery($id, $name, $quantity);
                    header('Location: index.php');
                } else {
                    include './view/edit.php';
                }
                break;

            case 'delete':
                $id = $_GET['id'];
                $this->model->deleteGrocery($id);
                header('Location: index.php');
                break;

            default:
                $groceries = $this->model->getAllGroceries();
                include './view/dashboard.php';
                break;
                
        case 'login': // +
    if ($_SERVER['REQUEST_METHOD'] === 'POST') { // +
        $username = $_POST['username']; // +
        $password = $_POST['password']; // +
        $remember = isset($_POST['remember']); // +
        if (loginUser($username, $password, $remember)) { // +
            header('Location: index.php'); // +
        } else { // +
            setFlash('error', 'Invalid username or password.'); // +
            include './view/login.php'; // +
        } // +
    } else { include './view/login.php'; } // +
    break; // +

case 'register': // +
    if ($_SERVER['REQUEST_METHOD'] === 'POST') { // +
        $username = $_POST['username']; // +
        $password = $_POST['password']; // +
        $confirm = $_POST['confirm']; // +

        if (empty($username) || empty($password)) { $error = "All fields are required."; } // +
        elseif ($password !== $confirm) { $error = "Passwords do not match."; } // +
        else { // +
            require './db.php'; // +
            $stmt = $db->prepare("SELECT id FROM users WHERE username = ?"); // +
            $stmt->execute([$username]); // +
            if ($stmt->fetch()) { $error = "Username already exists."; } // +
            else { // +
                $hashed = password_hash($password, PASSWORD_DEFAULT); // +
                $insert = $db->prepare("INSERT INTO users (username, password) VALUES (?, ?)"); // +
                $insert->execute([$username, $hashed]); // +
                setFlash('success', 'Registration successful. You can now log in.'); // +
                header('Location: index.php?action=login'); exit(); // +
            } // +
        } // +
        include './view/register.php'; // +
    } else {
        include './view/register.php'; // +
    }
    break; // +

case 'logout': // +
    logoutUser(); // +
    header('Location: index.php'); // +
    break; // +    
        }
    }
}
?>

