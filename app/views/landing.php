<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Musicboxd</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="assets/css/userHeader.css">
    <link rel="stylesheet" href="assets/css/landing_style.css">

</head>

<body>

    <?php require BASE_PATH . '/app/views/components/landingPageHeader.php'; ?>

    <main>
        <h1>Welcome to Musicboxd</h1>
        <h3>Song Reviews: <?= htmlspecialchars($totalSongReviews) ?></h3>
        <h3>My Song Reviews: <?= htmlspecialchars($songsReviewed) ?></h3>
        <h2>Trending Songs</h2>
        <div class = "holder">
            <?php foreach ($trendingSongs as $song): ?>
                <!-- for the foreach in php -->
                <article class = "card center">
                    <img 
                            src = <?= htmlspecialchars($song->url) ?>
                            alt = '<?= htmlspecialchars($song->album) ?> cover'
                            width = 150px
                            height = 150px
                        >
                    <div>
                        <h3>
                            <?= htmlspecialchars($song->title) ?>
                        </h3>
                        <p><?= htmlspecialchars($song->artist)?></p>
                        <p><?= htmlspecialchars($song->avg_rating) ?></p>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
        <h3>Album Reviews: <?= htmlspecialchars($totalAlbumReviews) ?></h3>
        <h3>My Album Reviews: <?= htmlspecialchars($albumsReviewed) ?></h3>
        <h2>Trending Albums</h2>
        <div class = "holder">
            <?php foreach ($trendingAlbums as $album): ?>
                <!-- for the foreach in php -->
                <article class = "card center">
                    <div>
                        <img 
                            src = <?= htmlspecialchars($album->url) ?>
                            alt = '<?= htmlspecialchars($album->title) ?> cover'
                            width = 150px
                            height = 150px
                        >
                        <h3>
                            <?= htmlspecialchars($album->title) ?>
                        </h3>
                        <p><?= htmlspecialchars($album->artist)?></p>
                        <p><?= htmlspecialchars($album->avg_rating) ?></p>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
        <h2> Trending Song Reviews</h2>
        <div class = "holder">
            <?php foreach ($trendingSongReviews as $songReview): ?>
                <!-- for the foreach in php -->
                <article class = "card">
                    <div class = "musicinfo">
                        <div>
                            <h3><?= htmlspecialchars($songReview->title) ?></h3>
                            <p><em><?= htmlspecialchars($songReview->artist)?></em></p>
                        </div>
                        <h1><?= htmlspecialchars($songReview->rating) ?></h1>
                    </div>
                    <hr>
                    <h3><?= htmlspecialchars($songReview->username) ?></h3>
                    <p><?= htmlspecialchars($songReview->review_text) ?></p>
                    <hr>
                    <small><?= htmlspecialchars(date('Y-m-d', strtotime($songReview->created_at))) ?></small>
                    <div class="review-likes">♡ <?= htmlspecialchars($songReview->likes) ?> people liked this review</div>
                </article>
            <?php endforeach; ?>
        </div>
        <h2> Trending Album Reviews</h2>
        <div class = "holder">
            <?php foreach ($trendingAlbumReviews as $albumReview): ?>
                <!-- for the foreach in php -->
                <article class = "card">
                    <div class = "musicinfo">
                        <div>
                            <h3><?= htmlspecialchars($albumReview->title) ?></h3>
                            <p><em><?= htmlspecialchars($albumReview->artist)?></em></p>
                        </div>
                        <h1><?= htmlspecialchars($albumReview->rating) ?></h1>
                    </div>
                    <hr>
                    <h3><?= htmlspecialchars($albumReview->username) ?></h3>
                    <p><?= htmlspecialchars($albumReview->review_text) ?></p>
                    <hr>
                    <small><?= htmlspecialchars(date('Y-m-d', strtotime($albumReview->created_at))) ?></small>
                    <div class="review-likes">♡ <?= htmlspecialchars($albumReview->likes) ?> people liked this review</div>
                </article>
            <?php endforeach; ?>
        </div>
    </main>

</body>

</html>