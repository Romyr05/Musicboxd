<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Journal</title>
    <link rel="stylesheet" href="assets/css/userHeader.css">
    <link rel="stylesheet" href="assets/css/journal_style.css">
</head>

<body>
<?php require BASE_PATH . '/app/views/components/journalHeader.php'; ?>

<main class="journal-page">
    <h1 class="journal-title">User's Journal</h1>
    
    <div class="journal-controls">
        <input type="text" class="journal-search" placeholder="Search Reviews" hidden>
        
        <form method="GET" enctype="multipart/form-data" class="journal-filters">
            <div class="filter-group">
                <label class="filter-label">Review Type</label>
                <select class="filter-select" name="journal-type" onchange="this.form.submit()">
                    <option value="any" <?php echo  ($reviewType === 'any') ? 'selected' : '' ?>>Any</option>
                    <option value="albums" <?php echo($reviewType === 'albums') ? 'selected' : '' ?>>Albums</option>
                    <option value="songs" <?php echo ($reviewType === 'songs') ? 'selected' : '' ?>>Songs</option>
                </select>
            </div>
            
            <div class="filter-group">
                <label class="filter-label">Sort By</label>
                <select class="filter-select" name="journal-sort" onchange="this.form.submit()">
                    <option value="recent" <?php echo ($sortBy === 'recent') ? 'selected' : '' ?>>Recent</option>
                    <option value="oldest" <?php echo ($sortBy === 'oldest') ? 'selected' : '' ?>>Oldest</option>
                    <option value="rating" <?php echo ($sortBy === 'rating') ? 'selected' : '' ?>>Highest Rating</option>
                </select>
            </div>
            
            <div class="filter-group">
                <label class="filter-label">Year Released</label>
                <select class="filter-select" name="journal-year" onchange="this.form.submit()">
                    <option value="any" <?php echo ($year === 'any') ? 'selected' : '' ?>>Any</option>
                    <?php foreach($review_years as $yearRow):?>
                        <option value="<?= htmlspecialchars($yearRow['year_released']) ?>" 
                        <?= ($year === (string)$yearRow['year_released']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($yearRow['year_released']) ?>
                        </option>
                    <?php endforeach;?>
                </select>
            </div>
            <!-- change as you will, pero wala ko may makita reason to add more options -->
            <!-- <div class="filter-group">
                <-- FEET get all available artists  
                <-- helper to preserve button state 
                <input type="hidden" name="extra_filters" value="<?php// echo $extra_state?>"> 

                <label class="filter-label">Extra Options</label>
                <button name="extra_filters" value="<?php //echo ($extra_state === 'show') ? 'hide' : 'show' ?>" class="additional-filters-btn">
                    <?php //echo ($extra_state === 'hide') ? "Show Additional Filters" : "Hide Filters" ?>     
                </button>
            </div>-->
        </form>
    </div>
    
    <div class="reviews-grid">
        <?php if(empty($reviews)):?>
            <div class="review-card">
                <div class="review-image"></div>
                <div class="review-content">
                    <div class="review-header">
                        <div class="review-type">No reviews yet!</div>
                        <span class="review-rating">0.0</span>
                    </div>
                    <p class="review-artist">Why not try sharing your thoughts?</p>
                    <p class="review-date">-</p>
                    <p class="review-text">You haven't reviewed anything matching these filters yet.</p>
                    <div class="review-footer">
                        <span class="review-likes">♡  0 people liked your review</span>
                        <button class="edit-review-btn" disabled hidden>Edit Review</button>
                    </div>
                </div>
            </div>
        <?php else:?>
            <?php foreach($reviews as $review):?>
                <div class="review-card">
                    <div class="review-image"></div>
                    <div class="review-content">
                        <div class="review-header">
                            <div class="review-type"><?= ($review['item_type']) ?></div>
                            <span class="review-rating"><?= htmlspecialchars($review['rating']) ?></span>
                        </div>
                        <p class="review-artist"><?= htmlspecialchars($review['artist_name']) ?></p>
                        <p class="review-date"><?= htmlspecialchars($review['created_at']) ?></p>
                        <p class="review-text"><?= htmlspecialchars($review['review_text']) ?></p>
                        <div class="review-footer">
                            <span class="review-likes">♡  <?= htmlspecialchars($review['likes']) ?> people liked your review</span>
                            <button class="edit-review-btn" hidden>Edit Review</button>
                        </div>
                    </div>
                </div>
            <?php endforeach;?>
        <?php endif;?>
    </div>

        
    </div>
    
</main>

</body>
</html>
