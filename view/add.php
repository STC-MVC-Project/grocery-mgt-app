<?php 
$activePage = 'add';
include 'header.php'; 
?>
<main>
    <section class="form-container">
        <h2>Add Grocery Item</h2>

        <?php if (!empty($error)) : ?>
            <div class="error-message"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="post">
            <fieldset>
                <legend>Grocery Details</legend>

                <label for="name">Item Name</label>
                <input type="text" id="name" name="name" placeholder="e.g. Apples" required>

                <label for="quantity">Quantity</label>
                <input type="number" id="quantity" name="quantity" placeholder="e.g. 5" required>

                <button type="submit">Add Item</button>
            </fieldset>
        </form>
    </section>
</main>
<?php include 'footer.php'; ?>

