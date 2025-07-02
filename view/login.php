<?php include 'header.php'; ?>
<main>
    <h2>Login</h2>
    <form method="post">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <label><input type="checkbox" name="remember"> Remember Me</label> <!-- + -->
        <button type="submit">Login</button>
    </form>
    <p>Don't have an account? <a href="index.php?action=register">Register</a></p>
</main>
<?php include 'footer.php'; ?>
