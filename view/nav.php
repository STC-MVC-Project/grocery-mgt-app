<?php
if (!isset($activePage)) {
    $activePage = ''; 
}
?>
<nav class="main-nav">
    <ul>
        <li><a href="index.php" class="<?= ($activePage == 'dashboard') ? 'active' : '' ?>">🏠 Dashboard</a></li>
        <li><a href="index.php?action=add" class="<?= ($activePage == 'add') ? 'active' : '' ?>">➕ Add Grocery</a></li>
    </ul>
</nav>
