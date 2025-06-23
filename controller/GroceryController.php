<?php
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
        }
    }
}
?>

