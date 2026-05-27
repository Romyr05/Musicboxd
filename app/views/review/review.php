<!DOCTYPE html>
<html lang=en>
<head>
<meta charset="UTF-8">
    <title>Review</title>
    <link rel="stylesheet" href="assets/css/userHeader.css">
    <link rel="stylesheet" href="/public/assets/css/review_styling.css">
</head>
<body>
<?php require BASE_PATH . '/app/views/components/journalHeader.php'; ?>

    <main class="review-page">
        
        <header class="review-header">
            <h2><?= $isEdit ? 'Edit Review' : 'Add a Review' ?></h2>
        </header>

        <form action="<?= $isEdit? '/review?action=update' : '/review?action=store' ?>" method="POST">
            
            <?php if($isEdit): ?>
                <input type="hidden" name="review_id" value="<?= htmlspecialchars($review['id'] ?? '') ?>">
            <?php endif; ?>
            
            <input type="hidden" name="item_id" value="<?= htmlspecialchars($item['id'] ?? $review['id'] ?? '') ?>">
            <input type="hidden" name="item_type" value="<?= htmlspecialchars($review_type ?? '') ?>">
            <input type="hidden" id="form-action-type" name="action_method" value="save">

            <div class="form-left">
                <div class="form-cover">
                    <?php if(!empty($item['album_cover_url']) || !empty($review['album_cover_url'])): ?>
                        <img src="<?= htmlspecialchars($item['album_cover_url'] ?? $review['album_cover_url']) ?>" alt="Cover Artwork">
                    <?php else: ?>
                        <div class="fallback-icon">🎵</div>
                    <?php endif; ?>
                </div>

                <div class="rating-block">
                    <label>Your Rating</label>
                    <div class="star-rating">
                        <?php $currentRating = (int)($review['rating'] ?? 0); ?>
                        <?php for($i = 5; $i >= 1; $i--): ?>
                            <input type="radio" id="star<?= $i ?>" name="rating" value="<?= $i ?>" <?= $currentRating === $i ? 'checked' : '' ?>>
                            <label for="star<?= $i ?>">★</label>
                        <?php endfor; ?>
                    </div>
                </div>
            </div>

            <div class="form-right">
                
                <div class="form-first-row">
                    <div class="form-song-album-title">
                        <label>Track / Album Name</label>
                        <p class="dynamic-data"><?= htmlspecialchars($item['title'] ?? $review['title'] ?? 'Unknown Title') ?></p>
                    </div>
                    <div class="form-year-released">
                        <label>Year</label>
                        <p class="dynamic-data"><?= htmlspecialchars($item['year_released'] ?? $review['year_released'] ?? '-') ?></p>
                    </div>
                </div>

                <div class="form-sec-row">
                    <div class="form-artist">
                        <label>Artist</label>
                        <p class="dynamic-data"><?= htmlspecialchars($item['artist_names'] ?? $review['artist_names'] ?? 'Unknown Artist') ?></p>
                    </div>
                    <div class="form-date-created">
                        <label>Logged On</label>
                        <p class="dynamic-data"><?= htmlspecialchars($review['date_created'] ?? date('m/d/Y')) ?></p>
                    </div>
                </div>

                <div class="form-favorite">
                    <input type="checkbox" id="favorited" name="favorited" value="1" <?= (!empty($review['favorited'])) ? 'checked' : '' ?>>
                    <label for="favorited">Add to favorites? </label>
                </div>

                <div class="form-text-editor">
                    <label for="review_text">Review</label>
                    <textarea id="review_text" name="review_text" placeholder="Write your review here..." required><?= htmlspecialchars($review['review_text'] ?? '') ?></textarea>
                </div>

                <footer class="form-actions">
                    <div class="right-buttons">
                        <a href="/journal" class="cancelLinkBtn" onclick="return confirm('Are you sure you want to discard your changes?');">Cancel</a>
                        
                        <?php if ($isEdit): ?>
                            <button type="submit" class="deleteBtn" onclick="if(confirm('Are you sure you want to delete this review?')) { document.getElementById('form-action-type').value = 'delete'; } else { return false; }">Delete</button>
                        <?php endif; ?>
                        
                        <button type="submit" class="saveBtn">Save</button>
                    </div>
                </footer>

            </div>
        </form>
    </main>

</body>
</html>