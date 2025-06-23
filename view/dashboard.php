<?php include 'header.php'; ?>
<main>
    <h2>Grocery List</h2>
    <table>
        <tr><th>Name</th><th>Quantity</th><th>Actions</th></tr>
        <?php foreach ($groceries as $grocery): ?>
            <tr>
                <td><?= htmlspecialchars($grocery['name']) ?></td>
                <td><?= htmlspecialchars($grocery['quantity']) ?></td>
                <td>
                    <a href="index.php?action=edit&id=<?= $grocery['id'] ?>">Edit</a>
                    <a href="index.php?action=delete&id=<?= $grocery['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</main>
<?php include 'footer.php'; ?>
