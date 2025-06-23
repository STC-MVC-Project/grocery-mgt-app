<?php
require_once './db.php';

class Grocery {
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
}
?>
