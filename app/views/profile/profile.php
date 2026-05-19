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
                <h1>Username</h1>
                <span>Joined 2026-08-31</span>
            </div>

            <button>Edit Profile</button>
        </div>
    </div>

    <div class="profile-right">
        <div class="profile-stats">
            <div class="stat">
                <h3>Songs<br>Reviewed</h3>
                <strong>67</strong>
            </div>

            <div class="stat">
                <h3>Albums<br>Reviewed</h3>
                <strong>21</strong>
            </div>
        </div>

        <a href="journal" class="journal-button">View Full Journal</a>
    </div>
</section>

    <section class="profile-review-grid">
        <div class="review-section">
            <h2>Highest Rated Songs</h2>

            <div class="review-cards">
                <article class="review-card">
                    <div class="review-card-top">
                        <div>
                            <strong>Song</strong>
                            <span>Artist</span>
                        </div>
                        <strong>5.0</strong>
                    </div>

                    <h3>Username</h3>
                    <p>This song saved my life. I loved it from start to finish.</p>

                    <small>2021-04-03</small>

                    <div class="review-likes">♡ 123 people liked this review</div>
                </article>
            </div>
        </div>

        <div class="review-section">
            <h2>Recent Song Reviews</h2>
            <div class="review-cards">
                <article class="review-card">
                    <div class="review-card-top">
                        <div>
                            <strong>Song</strong>
                            <span>Artist</span>
                        </div>
                        <strong>5.0</strong>
                    </div>

                    <h3>Username</h3>
                    <p>This song saved my life. I loved it from start to finish.</p>

                    <small>2021-04-03</small>

                    <div class="review-likes">♡ 123 people liked this review</div>
                </article>
            </div>
        </div>

        <div class="review-section">
            <h2>Highest Rated Albums</h2>
            <div class="review-cards">
                <article class="review-card">
                    <div class="review-card-top">
                        <div>
                            <strong>Song</strong>
                            <span>Artist</span>
                        </div>
                        <strong>5.0</strong>
                    </div>

                    <h3>Username</h3>
                    <p>This song saved my life. I loved it from start to finish.</p>

                    <small>2021-04-03</small>

                    <div class="review-likes">♡ 123 people liked this review</div>
                </article>
            </div>
        </div>

        <div class="review-section">
            <h2>Recent Album Reviews</h2>
            <div class="review-cards">
                <article class="review-card">
                    <div class="review-card-top">
                        <div>
                            <strong>Song</strong>
                            <span>Artist</span>
                        </div>
                        <strong>5.0</strong>
                    </div>

                    <h3>Username</h3>
                    <p>This song saved my life. I loved it from start to finish.</p>

                    <small>2021-04-03</small>

                    <div class="review-likes">♡ 123 people liked this review</div>
                </article>
            </div>
        </div>
    </section>

</main>



</body>
</html> 
