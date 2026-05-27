<!-- use the userHeader css for this -->

<header class="site-header">


    <a href="./" class="brand">Musicboxd</a>

    <nav class="header-nav">
        <a href="profile" class="nav-button">
            <i class="bi bi-search" aria-hidden="true"></i>
            <span>  My Profile</span>
        </a>

        <a href="journal" class="nav-button">
            <i class="bi bi-search" aria-hidden="true"></i>
            <span> My Journal</span>
        </a>
    </nav>
    <?php
    require_once BASE_PATH . '/app/includes/auth.php';
    if (isLoggedIn()): ?>
        <div class="user-actions">
            <span class="username"><?= htmlspecialchars(currentUsername()) ?></span>
            <a href="logout" class="logout-link">Logout</a>
        </div>
    <?php endif; ?>
        

</header>
