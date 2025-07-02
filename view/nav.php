<?php
if (!isset($activePage)) {
    $activePage = '';
}
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<nav class="main-nav">
    <ul class="nav-menu">
        <li><a href="index.php" class="<?= ($activePage == 'dashboard') ? 'active' : '' ?>">🏠 Shopping</a></li>
        <li><a href="index.php?action=add" class="<?= ($activePage == 'add') ? 'active' : '' ?>">➕ Add Item</a></li>
        <li><a href="index.php?action=cart" class="<?= ($activePage == 'cart') ? 'active' : '' ?>">🛒 Cart</a></li>

        <li class="nav-spacer"></li>

        <?php if (isset($_SESSION['user'])) : ?>
            <li class="nav-user">👤 <?= htmlspecialchars($_SESSION['user']['username']) ?></li>
            <li><a href="index.php?action=logout" class="<?= ($activePage == 'logout') ? 'active' : '' ?>">Logout</a></li>
        <?php else : ?>
            <li><a href="index.php?action=login" class="<?= ($activePage == 'login') ? 'active' : '' ?>">🔐 Login</a></li>
            <li><a href="index.php?action=register" class="<?= ($activePage == 'register') ? 'active' : '' ?>">📝 Register</a></li>
        <?php endif; ?>
    </ul>
</nav>
