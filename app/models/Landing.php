<?php

# base logic 
require_once BASE_PATH . '/app/config/database.php';


class Landing
{
    private $DISPLAY_LIMIT = 4;
    public function getTrendingSongs(): array
    {
        $stmt = db()->prepare(
            "WITH
                reviews AS (
                    SELECT
                        song_reviews.song_id,
                        COUNT(*) as review_count,
                        ROUND(AVG(rating), 2) as avg_rating
                    FROM
                        song_reviews
                    GROUP BY
                        song_reviews.song_id
                    LIMIT {$this->DISPLAY_LIMIT}
                )
            SELECT
                songs.id,
                songs.title,
                reviews.review_count,
                reviews.avg_rating,
                artists.name as artist,
                albums.album_cover_url as url,
                albums.title as album
            FROM
                songs
                JOIN reviews ON songs.id = reviews.song_id
                JOIN song_artists ON songs.id = song_artists.song_id
                JOIN artists ON artists.id = song_artists.artist_id
                LEFT JOIN albums ON songs.album_id = albums.id
            ORDER BY review_count DESC, avg_rating DESC
            "
        );
        $stmt->execute();
        $trendingSongs = $stmt->fetchAll();

        return $trendingSongs;
    }

    public function getTrendingAlbums(): array
    {
        $stmt = db()->prepare(
            "WITH
                reviews AS (
                    SELECT
                        album_reviews.album_id,
                        COUNT(*) as review_count,
                        ROUND(AVG(rating), 2) as avg_rating
                    FROM
                        album_reviews
                    GROUP BY
                        album_reviews.album_id
                    LIMIT {$this->DISPLAY_LIMIT}
                )
            SELECT
                albums.id,
                albums.title,
                albums.album_cover_url as url,
                reviews.review_count,
                reviews.avg_rating,
                artists.name as artist
            FROM
                albums
                JOIN reviews ON albums.id = reviews.album_id
                JOIN album_artists ON albums.id = album_artists.album_id
                JOIN artists ON artists.id = album_artists.artist_id
            ORDER BY review_count DESC, avg_rating DESC
            "
        );
        $stmt->execute();
        $trendingAlbums = $stmt->fetchAll();

        return $trendingAlbums;
    }
    public function getTrendingSongReviews(): array{
        $stmt = db()->prepare(
            "WITH
            reviews AS(
                SELECT
                song_reviews.user_id,
                song_reviews.likes,
                song_reviews.song_id,
                song_reviews.rating,
                song_reviews.review_text,
                song_reviews.created_at
                FROM
                song_reviews
                ORDER BY likes DESC, rating DESC, created_at DESC
                LIMIT {$this->DISPLAY_LIMIT}
            )
            SELECT
                reviews.likes,
                reviews.rating,
                reviews.review_text,
                reviews.created_at,
                artists.name as artist,
                songs.title as title,
                users.username

                FROM reviews
                JOIN users ON reviews.user_id = users.id
                JOIN songs ON reviews.song_id = songs.id
                JOIN song_artists ON reviews.song_id = song_artists.song_id
                JOIN artists ON song_artists.artist_id = artists.id
            "
        );
        $stmt->execute();
        $trendingSongReviews = $stmt->fetchAll();
        return $trendingSongReviews;

    }

    public function getTrendingAlbumReviews(): array{
        $stmt = db()->prepare(
            "WITH
            reviews AS(
                SELECT
                album_reviews.user_id,
                album_reviews.likes,
                album_reviews.album_id,
                album_reviews.rating,
                album_reviews.review_text,
                album_reviews.created_at
                FROM
                album_reviews
                ORDER BY likes DESC, rating DESC, created_at DESC
                LIMIT {$this->DISPLAY_LIMIT}
            )
            SELECT
                reviews.likes,
                reviews.rating,
                reviews.review_text,
                reviews.created_at,
                artists.name as artist,
                albums.title as title,
                users.username

                FROM reviews
                JOIN users ON reviews.user_id = users.id
                JOIN albums ON reviews.album_id = albums.id
                JOIN album_artists ON reviews.album_id = album_artists.album_id
                JOIN artists ON album_artists.artist_id = artists.id
            "
        );
        $stmt->execute();
        $trendingAlbumReviews = $stmt->fetchAll();
        return $trendingAlbumReviews;

    }

    public function countTotalSongReviews():int{
        $stmt = db()->prepare(
            "SELECT COUNT(*)
            FROM song_reviews
            "
        );
        $stmt->execute();
        $totalSongReviews = $stmt->fetchColumn();

        return (int) $totalSongReviews;
    }
    public function countTotalAlbumReviews():int{
        $stmt = db()->prepare(
            "SELECT COUNT(*)
            FROM album_reviews
            "
        );
        $stmt->execute();
        $totalAlbumReviews = $stmt->fetchColumn();

        return (int) $totalAlbumReviews;
    }

}

?>