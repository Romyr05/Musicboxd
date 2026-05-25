
<header class="site-header">
    <a href="/" class="brand">Musicboxd</a>

    <nav class="header-nav">
        <a href="/users" class="nav-button">
            <i class="bi bi-search" aria-hidden="true"></i>
            <span>Browse Users</span>
        </a>

        <a href="/songs" class="nav-button">
            <i class="bi bi-search" aria-hidden="true"></i>
            <span>Browse Songs</span>
        </a>

        <a href="/albums" class="nav-button">
            <i class="bi bi-search" aria-hidden="true"></i>
            <span>Browse Albums</span>
        </a>
    </nav>

    <?php
    require_once BASE_PATH . '/app/includes/auth.php';
    if (isLoggedIn()): ?>
        <div class="user-actions">
            <a href="profile">
                <span class="username"><?= htmlspecialchars(currentUsername()) ?></span>
            </a>
            <a href="logout" class="logout-link">Logout</a>
        </div>
    <?php endif; ?>
</header>
