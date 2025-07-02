<?php include 'header.php'; ?>
<main>
    <h2>Register</h2>
    <?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="post">
        <input type="text" name="username" placeholder="Choose a Username" required>
        <input type="password" name="password" placeholder="Choose a Password" required>
        <input type="password" name="confirm" placeholder="Confirm Password" required>
        <button type="submit">Register</button>
    </form>
    <p>Already have an account? <a href="index.php?action=login">Login</a></p>
</main>
<?php include 'footer.php'; ?>
