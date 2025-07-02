<?php
require_once './auth.php'; // +
if (!isset($activePage)) {
    $activePage = ''; 
}
?>
<nav class="main-nav">
    <ul>
        <li><a href="index.php" class="<?= ($activePage == 'dashboard') ? 'active' : '' ?>">🏠 Dashboard</a></li>
        <li><a href="index.php?action=add" class="<?= ($activePage == 'add') ? 'active' : '' ?>">➕ Add Grocery</a></li>
    </ul>
    <?php if (isLoggedIn()): ?>
        <span style="color:white;">Welcome, <?= htmlspecialchars($_SESSION['user']['username']) ?></span>
        <a href="index.php?action=logout">Logout</a>
    <?php else: ?>
        <a href="index.php?action=login">Login</a>
        <a href="index.php?action=register">Register</a> <!-- + --> 
    <?php endif; ?>
    
</nav>
