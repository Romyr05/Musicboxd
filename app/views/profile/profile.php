<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Profile</title>
    <link rel="stylesheet" href="assets/css/userHeader.css">
    <link rel="stylesheet" href="assets/css/profile_styling.css">
</head>

<body>
    <?php require BASE_PATH . '/app/views/components/journalHeader.php'; ?>

    <main class="profile-page">

        <section class="profile-summary">
            <div class="profile-left">
                <div class="avatar-placeholder"></div>

                <div class="profile-info">
                    <div class="profile-name-row">
                        <h1><?= htmlspecialchars($user->username) ?></h1>
                        <span><?= htmlspecialchars(date('Y-m-d', strtotime($user->created_at))) ?></span>
                    </div>

                    <button disabled>Edit Profile</button>
                </div>
            </div>

            <div class="profile-right">
                <div class="profile-stats">
                    <div class="stat">
                        <h3>Songs<br>Reviewed</h3>
                        <strong><?= htmlspecialchars($songsReviewed) ?></strong>
                    </div>

                    <div class="stat">
                        <h3>Albums<br>Reviewed</h3>
                        <strong><?= htmlspecialchars($albumsReviewed) ?></strong>
                    </div>
                </div>

                <a href="journal" class="journal-button">View Full Journal</a>
            </div>
        </section>

        <!-- Made an php if else since no data as of the moment, just to show initial output -->
        <section class="profile-review-grid">
            <div class="review-section">
                <h2>Highest Rated Songs</h2>

                <div class="review-cards">
                    <?php if (empty($highestRatedSongs)): ?>
                        <article class="review-card">
                            <div class="review-card-top">
                                <div>
                                    <strong>Song ATM</strong>
                                    <span>Artist ATM</span>
                                </div>
                                <strong>5.0</strong>
                            </div>

                            <h3>Username</h3>
                            <p>This song saved my life. I loved it from start to finish.</p>

                            <small>2021-04-03</small>

                            <div class="review-likes">♡ 123 people liked this review</div>
                        </article>
                    <?php else: ?>
                        <?php foreach ($highestRatedSongs as $review): ?>
                            <!-- for the foreach in php -->
                            <article class="review-card">
                                <div class="review-card-top">
                                    <div>
                                        <strong>
                                            <?= htmlspecialchars($review->song_title)

                                                /* <?php foreach ($highestRatedSongs as $review): ?>
                                                <?= htmlspecialchars($review->song_title) ?>
                                                    <?php endforeach; ?>  

                                                */ ?> SONGS HERE


                                        </strong>
                                        <span><?= htmlspecialchars($review->artist_name) ?> </span>
                                    </div>
                                    <strong><?= htmlspecialchars($review->rating) ?></strong>
                                </div>

                                <h3><?= htmlspecialchars($user->username) ?></h3>
                                <p><?= htmlspecialchars($review->review_text) ?></p>

                                <small><?= htmlspecialchars((date('Y-m-d', strtotime($review->created_at)))) ?>TESTING</small>

                                <div class="review-likes">♡ <?= htmlspecialchars($review->likes) ?> people liked this review
                                </div>
                            </article>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>

            <div class="review-section">
                <h2>Recent Song Reviews</h2>
                <div class="review-cards">
                    <?php if (empty($recentSongReviews)): ?>
                        <article class="review-card">
                            <div class="review-card-top">
                                <div>
                                    <strong>Song ATM</strong>
                                    <span>Artist ATM</span>
                                </div>
                                <strong>5.0</strong>
                            </div>

                            <h3>Username</h3>
                            <p>This song saved my life. I loved it from start to finish.</p>

                            <small>2021-04-03</small>

                            <div class="review-likes">♡ 123 people liked this review</div>
                        </article>
                    <?php else: ?>
                        <?php foreach ($recentSongReviews as $review): ?>
                            <article class="review-card">
                                <div class="review-card-top">
                                    <div>
                                        <strong><?= htmlspecialchars($review->song_title) ?></strong>
                                        <span><?= htmlspecialchars($review->artist_name) ?></span>
                                    </div>
                                    <strong><?= htmlspecialchars($review->rating) ?></strong>
                                </div>

                                <h3><?= htmlspecialchars($user->username) ?></h3>
                                <p><?= htmlspecialchars($review->review_text) ?></p>

                                <small><?= htmlspecialchars(date('Y-m-d', strtotime($review->created_at))) ?></small>

                                <div class="review-likes">♡ <?= htmlspecialchars($review->likes) ?> people liked this review
                                </div>
                            </article>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>

            <div class="review-section">
                <h2>Highest Rated Albums</h2>
                <div class="review-cards">
                    <?php if (empty($highestRatedAlbums)): ?>
                        <article class="review-card">
                            <div class="review-card-top">
                                <div>
                                    <strong>Album ATM</strong>
                                    <span>Artist ATM</span>
                                </div>
                                <strong>5.0</strong>
                            </div>

                            <h3>Username</h3>
                            <p>This album stayed with me from start to finish.</p>

                            <small>2021-04-03</small>

                            <div class="review-likes">♡ 123 people liked this review</div>
                        </article>
                    <?php else: ?>
                        <?php foreach ($highestRatedAlbums as $review): ?>
                            <article class="review-card">
                                <div class="review-card-top">
                                    <div>
                                        <strong><?= htmlspecialchars($review->album_title) ?></strong>
                                        <span><?= htmlspecialchars($review->artist_name) ?></span>
                                    </div>
                                    <strong><?= htmlspecialchars($review->rating) ?></strong>
                                </div>

                                <h3><?= htmlspecialchars($user->username) ?></h3>
                                <p><?= htmlspecialchars($review->review_text) ?></p>

                                <small><?= htmlspecialchars(date('Y-m-d', strtotime($review->created_at))) ?></small>

                                <div class="review-likes">♡ <?= htmlspecialchars($review->likes) ?> people liked this review
                                </div>
                            </article>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>


            <div class="review-section">
                <h2>Recent Album Reviews</h2>
                <div class="review-cards">
                    <?php if (empty($recentAlbumReviews)): ?>
                        <article class="review-card">
                            <div class="review-card-top">
                                <div>
                                    <strong>Album ATM</strong>
                                    <span>Artist ATM</span>
                                </div>
                                <strong>5.0</strong>
                            </div>

                            <h3>Username</h3>
                            <p>This album stayed with me from start to finish.</p>

                            <small>2021-04-03</small>

                            <div class="review-likes">♡ 123 people liked this review</div>
                        </article>
                    <?php else: ?>
                        <?php foreach ($recentAlbumReviews as $review): ?>
                            <article class="review-card">
                                <div class="review-card-top">
                                    <div>
                                        <strong><?= htmlspecialchars($review->album_title) ?></strong>
                                        <span><?= htmlspecialchars($review->artist_name) ?></span>
                                    </div>
                                    <strong><?= htmlspecialchars($review->rating) ?></strong>
                                </div>

                                <h3><?= htmlspecialchars($user->username) ?></h3>
                                <p><?= htmlspecialchars($review->review_text) ?></p>

                                <small><?= htmlspecialchars(date('Y-m-d', strtotime($review->created_at))) ?></small>

                                <div class="review-likes">♡ <?= htmlspecialchars($review->likes) ?> people liked this review
                                </div>
                            </article>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </section>

    </main>



</body>

</html>