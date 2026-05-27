
<header class="site-header">
    <a href="<?= url('/') ?>" class="brand">Musicboxd</a>

    <nav class="header-nav">
        <a href="<?= url('/users') ?>" class="nav-button">
            <i class="bi bi-search" aria-hidden="true"></i>
            <span>Browse Users</span>
        </a>

        <a href="<?= url('/songs') ?>" class="nav-button">
            <i class="bi bi-search" aria-hidden="true"></i>
            <span>Browse Songs</span>
        </a>

        <a href="<?= url('/albums') ?>" class="nav-button">
            <i class="bi bi-search" aria-hidden="true"></i>
            <span>Browse Albums</span>
        </a>
    </nav>

    <?php
    require_once BASE_PATH . '/app/includes/auth.php';
    if (isLoggedIn()): ?>
        <div class="user-actions">
            <a href="<?= url('/profile') ?>">
                <span class="username"><?= htmlspecialchars(currentUsername()) ?></span>
            </a>
            <a href="<?= url('/logout') ?>" class="logout-link">Logout</a>
        </div>
    <?php endif; ?>
</header>
