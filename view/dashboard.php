<?php 
$activePage = 'dashboard';
include 'header.php'; ?>

<main>
    <section class="dashboard-container">
        <h2>Grocery List</h2>

        <?php if (empty($groceries)) : ?>
            <p class="empty-message">Your grocery list is empty. Start adding items!</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr><th>Name</th><th>Quantity</th><th>Actions</th></tr>
                </thead>
                <tbody>
                    <?php foreach ($groceries as $grocery): ?>
                        <tr>
                            <td><?= htmlspecialchars($grocery['name']) ?></td>
                            <td><?= htmlspecialchars($grocery['quantity']) ?></td>
                            <td>
                                <a href="index.php?action=edit&id=<?= $grocery['id'] ?>" class="action-btn edit">✏️ Edit</a>
                                <a href="index.php?action=delete&id=<?= $grocery['id'] ?>" class="action-btn delete" onclick="return confirm('Are you sure?')">🗑️ Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </section>
</main>
<?php include 'footer.php'; ?>
