<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Songs</title>
    <link rel="stylesheet" href="assets/css/userHeader.css">
    <link rel="stylesheet" href="assets/css/songs_style.css">
</head>

<body>
<?php require BASE_PATH . '/app/views/components/journalHeader.php'; 
require_once BASE_PATH . '/app/includes/auth.php';
?>

<main class="songs-page">
    <h1 class="songs-title">Song Catalog</h1>
    
    <div class="songs-controls">
        <input type="text" class="songs-search" placeholder="Search Songs" hidden>
        
        <form method="GET" class="songs-filters">
            <div class="filter-group">
                <label class="filter-label">Sort By</label>
                <select class="filter-select" name="songs-sort" onchange="this.form.submit()">
                    <option value="recent" <?php echo ($sortBy === 'recent') ? 'selected' : '' ?>>Newest</option>
                    <option value="oldest" <?php echo ($sortBy === 'oldest') ? 'selected' : '' ?>>Oldest</option>
                    <option value="title" <?php echo ($sortBy === 'title') ? 'selected' : '' ?>>Title A-Z</option>
                </select>
            </div>
            
            <div class="filter-group">
                <label class="filter-label">Year Released</label>
                <select class="filter-select" name="songs-year" onchange="this.form.submit()">
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
    
    <div class="songs-grid">
        <?php if(empty($songs)):?>
            <div class="song-card">
                <div class="song-image"></div>
                <div class="song-content">
                    <div class="song-header">
                        <div class="song-type">No songs found</div>
                    </div>
                    <p class="song-artist">Try adjusting your filters</p>
                </div>
            </div>
        <?php else:?>
            <?php foreach($songs as $song):?>
                <div class="song-card">
                    <div class="song-image"></div>
                    <div class="song-content">
                        <div class="song-header">
                            <div class="song-type"><?= htmlspecialchars($song['genre'] ?? 'Unknown') ?></div>
                        </div>
                        <p class="song-name"><?= htmlspecialchars($song['song_title']) ?></p>
                        <p class="song-artist"><?= htmlspecialchars($song['artist_name']) ?></p>
                        <?php if(!empty($song['album_title'])): ?>
                            <p class="song-album">from <em><?= htmlspecialchars($song['album_title']) ?></em></p>
                        <?php endif; ?>
                        <p class="song-year"><?= htmlspecialchars($song['year_released'] ?? '-') ?></p>
                        <div class="song-footer">
                            <?php if(isLoggedIn()): ?>
                                <a href="<?= url('/review?song_id=' . htmlspecialchars($song['id'])) ?>" class="review-song-btn">Add Review</a>
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
