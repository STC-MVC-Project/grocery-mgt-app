<?php
require_once './db.php';

class Grocery {
    // --- Grocery CRUD ---
    public function getAllGroceries() {
        global $db;
        $query = 'SELECT * FROM groceries';
        return $db->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addGrocery($name, $quantity) {
        global $db;
        $stmt = $db->prepare('INSERT INTO groceries (name, quantity) VALUES (?, ?)');
        $stmt->execute([$name, $quantity]);
    }

    public function getGroceryById($id) {
        global $db;
        $stmt = $db->prepare('SELECT * FROM groceries WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateGrocery($id, $name, $quantity) {
        global $db;
        $stmt = $db->prepare('UPDATE groceries SET name = ?, quantity = ? WHERE id = ?');
        $stmt->execute([$name, $quantity, $id]);
    }

    public function deleteGrocery($id) {
        global $db;
        $stmt = $db->prepare('DELETE FROM groceries WHERE id = ?');
        $stmt->execute([$id]);
    }

    // --- User Methods ---
    public function findUser($username, $password) {
        global $db;
        $stmt = $db->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return null;
    }

    public function getUserByUsername($username) {
        global $db;
        $stmt = $db->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addUser($username, $email, $passwordHash) {
        global $db;
        $stmt = $db->prepare('INSERT INTO users (username, email, password) VALUES (?, ?, ?)');
        return $stmt->execute([$username, $email, $passwordHash]);
    }

    public function userExists($username, $email) {
        global $db;
        $stmt = $db->prepare('SELECT id FROM users WHERE username = ? OR email = ?');
        $stmt->execute([$username, $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC) !== false;
    }

    // --- Cart Methods ---
    public function getUserCart($userId) {
        global $db;
        $stmt = $db->prepare("SELECT item_name, quantity FROM cart_items WHERE user_id = ?");
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function saveCart($userId, $cart) {
        global $db;
        // Delete existing cart items for user
        $db->prepare("DELETE FROM cart_items WHERE user_id = ?")->execute([$userId]);

        $stmt = $db->prepare("INSERT INTO cart_items (user_id, item_name, quantity) VALUES (?, ?, ?)");
        foreach ($cart as $item) {
            if (!empty($item['name']) && !empty($item['quantity'])) {
                $stmt->execute([$userId, $item['name'], $item['quantity']]);
            }
        }
    }
}
?>
