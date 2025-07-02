<?php
session_start();
require_once './model/Grocery.php';

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
                        exit();
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
                    exit();
                } else {
                    include './view/edit.php';
                }
                break;

            case 'delete':
                $id = $_GET['id'];
                $this->model->deleteGrocery($id);
                header('Location: index.php');
                exit();
                break;

            case 'add_to_cart':
                $id = $_GET['id'] ?? null;
                if ($id && $_SERVER['REQUEST_METHOD'] === 'POST') {
                    $item = $this->model->getGroceryById($id);
                    if ($item) {
                        if (!isset($_SESSION['cart13'])) {
                            $_SESSION['cart13'] = [];
                        }

                        $quantity = isset($_POST['quantity']) ? max(1, (int)$_POST['quantity']) : 1;

                        // Check if item already in cart, update quantity if yes
                        $found = false;
                        foreach ($_SESSION['cart13'] as &$cartItem) {
                            if ($cartItem['name'] === $item['name']) {
                                $cartItem['quantity'] += $quantity;
                                $found = true;
                                break;
                            }
                        }
                        unset($cartItem);

                        if (!$found) {
                            $_SESSION['cart13'][] = ['name' => $item['name'], 'quantity' => $quantity];
                        }
                    }
                }
                header('Location: index.php?action=cart');
                exit();
                break;

            case 'remove_cart_item':
                $index = $_GET['index'] ?? null;
                if ($index !== null && isset($_SESSION['cart13'][$index])) {
                    unset($_SESSION['cart13'][$index]);
                    $_SESSION['cart13'] = array_values($_SESSION['cart13']);
                }
                header('Location: index.php?action=cart');
                exit();
                break;

            case 'update_cart_item':
                $index = $_POST['index'] ?? null;
                $quantity = $_POST['quantity'] ?? null;
                if ($index !== null && $quantity && isset($_SESSION['cart13'][$index])) {
                    $_SESSION['cart13'][$index]['quantity'] = max(1, (int)$quantity);
                }
                header('Location: index.php?action=cart');
                exit();
                break;

            case 'login':
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $username = $_POST['username'] ?? '';
                    $password = $_POST['password'] ?? '';

                    $user = $this->model->findUser($username, $password);
                    if ($user) {
                        $_SESSION['user'] = $user;

                        // Load cart from DB if user has saved cart
                        $cart = $this->model->getUserCart($user['id']);
                        $_SESSION['cart13'] = [];
                        foreach ($cart as $item) {
                            $_SESSION['cart13'][] = ['name' => $item['item_name'], 'quantity' => $item['quantity']];
                        }

                        header('Location: index.php');
                        exit();
                    } else {
                        $error = 'Invalid username or password';
                        include './view/login.php';
                    }
                } else {
                    include './view/login.php';
                }
                break;

            case 'logout':
                if (isset($_SESSION['user'])) {
                    $this->model->saveCart($_SESSION['user']['id'], $_SESSION['cart13'] ?? []);
                }
                session_destroy();
                header('Location: index.php');
                exit();
                break;

            case 'register':
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $username = trim($_POST['username']);
                    $email = trim($_POST['email']);
                    $password = $_POST['password'];
                    $password_confirm = $_POST['password_confirm'];

                    if (!$username || !$email || !$password || !$password_confirm) {
                        $error = 'All fields are required.';
                        include './view/register.php';
                        break;
                    }

                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $error = 'Invalid email format.';
                        include './view/register.php';
                        break;
                    }

                    if ($password !== $password_confirm) {
                        $error = 'Passwords do not match.';
                        include './view/register.php';
                        break;
                    }

                    if ($this->model->userExists($username, $email)) {
                        $error = 'Username or email already taken.';
                        include './view/register.php';
                        break;
                    }

                    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                    $added = $this->model->addUser($username, $email, $passwordHash);

                    if ($added) {
                        header('Location: index.php?action=login');
                        exit();
                    } else {
                        $error = 'Registration failed. Please try again.';
                        include './view/register.php';
                    }
                } else {
                    include './view/register.php';
                }
                break;

            case 'cart':
                include './view/cart.php';
                break;

            default:
                $groceries = $this->model->getAllGroceries();
                include './view/dashboard.php';
                break;
        }
    }
}
