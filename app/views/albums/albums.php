<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>albums</title>
    <link rel="stylesheet" href="assets/css/userHeader.css">
    <link rel="stylesheet" href="assets/css/albums_style.css">
</head>

<body>
<?php require BASE_PATH . '/app/views/components/journalHeader.php'; 
require_once BASE_PATH . '/app/includes/auth.php';
?>

<main class="albums-page">
    <h1 class="albums-title">Album Catalog</h1>
    
    <div class="albums-controls">
        <input type="text" class="albums-search" placeholder="Search albums" hidden>
        
        <form method="GET" class="albums-filters">
            <div class="filter-group">
                <label class="filter-label">Sort By</label>
                <select class="filter-select" name="albums-sort" onchange="this.form.submit()">
                    <option value="recent" <?php echo ($sortBy === 'recent') ? 'selected' : '' ?>>Newest</option>
                    <option value="oldest" <?php echo ($sortBy === 'oldest') ? 'selected' : '' ?>>Oldest</option>
                    <option value="title" <?php echo ($sortBy === 'title') ? 'selected' : '' ?>>Title A-Z</option>
                </select>
            </div>
            
            <div class="filter-group">
                <label class="filter-label">Year Released</label>
                <select class="filter-select" name="albums-year" onchange="this.form.submit()">
                    <option value="any" <?php echo ($year === 'any') ? 'selected' : '' ?>>Any</option>
                    <?php foreach($review_years as $yearRow):?>
                        <option value="<?= htmlspecialchars($yearRow['year_released']) ?>" 
                        <?= ($year === (string)$yearRow['year_released']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($yearRow['year_released']) ?>
                        </option>
                    <?php endforeach;?>
                </select>
            </div>
        </form>
    </div>
    
    <div class="albums-grid">
        <?php if(empty($albums)):?>
            <div class="album-card">
                <div class="album-image"></div>
                <div class="album-content">
                    <div class="album-header">
                        <div class="album-type">No albums found</div>
                    </div>
                    <p class="album-artist">Try adjusting your filters</p>
                </div>
            </div>
        <?php else:?>
            <?php foreach($albums as $album):?>
                <div class="album-card">
                    <div class="album-image"></div>
                    <div class="album-content">
                        <div class="album-header">
                            <div class="album-type"><?= htmlspecialchars($album['genre'] ?? 'Unknown') ?></div>
                        </div>
                        <p class="album-name"><?= htmlspecialchars($album['album_title']) ?></p>
                        <p class="album-artist"><?= htmlspecialchars($album['artist_name']) ?></p>
                        <p class="album-year"><?= htmlspecialchars($album['year_released'] ?? '-') ?></p>
                        <div class="album-footer">
                            <?php if(isLoggedIn()): ?>
                                <a href="<?= url('/review?album_id=' . htmlspecialchars($album['id'])) ?>" class="review-album-btn">Add Review</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach;?>
        <?php endif;?>
    </div>
        
</main>

</body>
</html>
