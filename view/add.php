<?php include 'header.php'; ?>
<main>
    <h2>Add Grocery</h2>
    <?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="post">
        <input type="text" name="name" placeholder="Name" required>
        <input type="number" name="quantity" placeholder="Quantity" required>
        <button type="submit">Add</button>
    </form>
</main>
<?php include 'footer.php'; ?>
