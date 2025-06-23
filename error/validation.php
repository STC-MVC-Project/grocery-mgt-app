<?php
function validateInput($name, $quantity) {
    if (empty($name) || empty($quantity)) return "All fields are required.";
    if (!is_numeric($quantity) || $quantity <= 0) return "Quantity must be a positive number.";
    return "";
}
?>


