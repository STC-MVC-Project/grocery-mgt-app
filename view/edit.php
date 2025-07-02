<?php 
$activePage = 'edit';
include 'header.php'; 

?>
<main>
    <section class="form-container">
        <h2>Edit Grocery Item</h2>

        <form method="post">
            <fieldset>
                <legend>Update Item</legend>

                <label for="name">Item Name</label>
                <input type="text" id="name" name="name" value="<?= htmlspecialchars($item['name']) ?>" required>

                <label for="quantity">Quantity</label>
                <input type="number" id="quantity" name="quantity" value="<?= htmlspecialchars($item['quantity']) ?>" required>

                <button type="submit">Update Item</button>
            </fieldset>
        </form>
    </section>
</main>
<?php include 'footer.php'; ?>
