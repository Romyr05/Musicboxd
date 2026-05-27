<?php 

require_once BASE_PATH . '/app/config/database.php'; // database


class Review {
    // song info
    public function getSong(int $songID): ?array {
        $stmt = db()->prepare(
            
            "SELECT
                songs.id,
                songs.title,
                songs.year_released,
                albums.album_cover_url,
                COALESCE(GROUP_CONCAT(artists.name SEPARATOR ', '), 'Unknown Artist') AS artist_names
            FROM songs
            LEFT JOIN song_artists ON song_artists.song_id = songs.id
            LEFT JOIN artists ON artists.id = song_artists.artist_id
            LEFT JOIN albums ON albums.id = songs.album_id
            WHERE songs.id = ?
            GROUP BY songs.id, songs.title, songs.year_released, albums.album_cover_url
            LIMIT 1"
            
        );

        $stmt->execute([$songID]);

        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    // album info
    public function getAlbum(int $albumID): ?array {
        $stmt = db()->prepare(
            
            "SELECT
                albums.id,
                albums.title,
                albums.year_released,
                albums.album_cover_url,
                COALESCE(GROUP_CONCAT(artists.name SEPARATOR ', '), 'Unknown Artist') AS artist_names
            FROM albums
            LEFT JOIN album_artists ON album_artists.album_id = albums.id
            LEFT JOIN artists ON artists.id = album_artists.artist_id
            WHERE albums.id = ?
            GROUP BY albums.id, albums.title, albums.year_released, albums.album_cover_url
            LIMIT 1"
            
        );

        $stmt->execute([$albumID]);

        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }


    // song review info
    public function getSongReview(int $userID, int $reviewID): ?array {
        $stmt = db()->prepare(

            "SELECT
                song_reviews.id, 
                song_reviews.rating, 
                song_reviews.review_text, 
                song_reviews.favorited, 
                DATE_FORMAT(song_reviews.created_at, '%m/%d/%Y') AS date_created,
                songs.title, 
                songs.year_released,
                albums.album_cover_url,
                COALESCE(GROUP_CONCAT(artists.name SEPARATOR ', '), 'Unknown Artist') AS artist_names
            FROM song_reviews
            LEFT JOIN songs         ON song_reviews.song_id = songs.id
            LEFT JOIN song_artists  ON song_artists.song_id = songs.id 
            LEFT JOIN artists       ON song_artists.artist_id = artists.id 
            LEFT JOIN albums        ON songs.album_id = albums.id
            WHERE song_reviews.user_id = ?
            AND song_reviews.id = ?
            GROUP BY song_reviews.id, songs.title, songs.year_released, albums.album_cover_url
            LIMIT 1"

        );

        $stmt->execute([$userID, $reviewID]);

        $song_review = $stmt->fetch(PDO::FETCH_ASSOC);

        return $song_review ?: null;
    }

    // album review info
    public function getAlbumReview(int $userID, int $reviewID): ?array {
        $stmt = db()->prepare(

            "SELECT
                album_reviews.id,
                album_reviews.rating, 
                album_reviews.review_text, 
                album_reviews.favorited, 
                DATE_FORMAT(album_reviews.created_at, '%m/%d/%Y') AS date_created, 
                albums.title, 
                albums.year_released,
                albums.album_cover_url,
                COALESCE(GROUP_CONCAT(artists.name SEPARATOR ', '), 'Unknown Artist') AS artist_names
            FROM album_reviews
            LEFT JOIN albums        ON album_reviews.album_id = albums.id
            LEFT JOIN album_artists ON album_artists.album_id = albums.id 
            LEFT JOIN artists       ON album_artists.artist_id = artists.id 
            WHERE album_reviews.user_id = ?
            AND album_reviews.id = ?
            GROUP BY album_reviews.id, albums.title, albums.year_released, albums.album_cover_url
            LIMIT 1"

        );
        $stmt->execute([$userID, $reviewID]);

        $album_review = $stmt->fetch(PDO::FETCH_ASSOC);

        return $album_review ?: null;
    }

    // creation of song review
    public function createSongReview(int $userID, int $songID, ?int $rating, ?string $review_text, int $favorite): bool {
        $stmt = db()->prepare(

            "INSERT INTO song_reviews (user_id, song_id, rating, review_text, favorited)
            VALUES (?, ?, ?, ?, ?)"

        );

        return $stmt->execute([$userID, $songID, $rating, $review_text, $favorite]);
    }

    // creation of album review
    public function createAlbumReview(int $userID, int $albumID, ?int $rating, ?string $review_text, int $favorite): bool {
        $stmt = db()->prepare(

            "INSERT INTO album_reviews (user_id, album_id, rating, review_text, favorited)
            VALUES (?, ?, ?, ?, ?)"

        );

        return $stmt->execute([$userID, $albumID, $rating, $review_text, $favorite]);
    }

    // editing of song review
    public function updateSongReview(?int $rating, ?string $review_text, int $favorite, int $reviewID, int $userID): bool {
        $stmt = db()->prepare(

            "UPDATE song_reviews
            SET rating = ?, review_text = ?, favorited = ?
            WHERE id = ?
            AND user_id = ?"

        );

        return $stmt->execute([$rating, $review_text, $favorite, $reviewID, $userID]);
    }

    // editing of album review
    public function updateAlbumReview(?int $rating, ?string $review_text, int $favorite, int $reviewID, int $userID): bool {
        $stmt = db()->prepare(

            "UPDATE album_reviews
            SET rating = ?, review_text = ?, favorited = ?
            WHERE id = ?
            AND user_id = ?"

        );

        return $stmt->execute([$rating, $review_text, $favorite, $reviewID, $userID]);
    }

    // deleting a song review
    public function deleteSongReview(int $reviewID, int $userID): bool {
        $stmt = db()->prepare(

            "DELETE FROM song_reviews
            WHERE id = ?
            AND user_id = ?"
        );

        return $stmt->execute([$reviewID, $userID]);
    }

    // deleting an album review
    public function deleteAlbumReview(int $reviewID, int $userID): bool {
        $stmt = db()->prepare(

            "DELETE FROM album_reviews
            WHERE id = ?
            AND user_id = ?"
        );

        return $stmt->execute([$reviewID, $userID]);
    }
}
?>