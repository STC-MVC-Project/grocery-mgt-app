<?php
require_once 'auth.php'; // +
autoLogin(); // +
require_once 'controller/GroceryController.php';
$controller = new GroceryController();
$controller->handleRequest();
?>

