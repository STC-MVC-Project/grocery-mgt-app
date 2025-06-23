<?php include 'header.php'; ?>
<main>
    <h2>Edit Grocery</h2>
    <form method="post">
        <input type="text" name="name" value="<?= $item['name'] ?>" required>
        <input type="number" name="quantity" value="<?= $item['quantity'] ?>" required>
        <button type="submit">Update</button>
    </form>
</main>
<?php include 'footer.php'; ?>
