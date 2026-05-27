<?php

require_once BASE_PATH . '/app/config/database.php';


class Journal {

    public function getFilteredReviews($userID, $reviewType, $sortBy, $year): array{
        if($reviewType === "albums"){
            return $this->getRatedAlbums($userID, $sortBy, $year);
        }else if($reviewType === "songs"){
            return $this->getRatedSongs($userID, $sortBy, $year);
        }else{
            return $this->getAllItems($userID, $sortBy, $year);
        }
    }

    // extra filters
    public function getReviewDates(): array{
        $stmt = db()->prepare(

            " SELECT DISTINCT year_released 
            FROM albums
            WHERE year_released IS NOT NULL
            UNION
            SELECT DISTINCT year_released
            FROM songs
            WHERE year_released IS NOT NULL
            ORDER BY year_released DESC
            " 
        );

        $stmt->execute();

        # pdo fetch_assoc translates the column numeric order into column names
        $years = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $years;
    }

    protected function getAllItems($userID, $sortby, $year): array{
        $sortprompt = "";
        if($sortby === "oldest"){
            $sortprompt = "ORDER BY created_at ASC";
        }else if($sortby === "rating"){
            $sortprompt = "ORDER BY rating DESC";
        }else{
            $sortprompt = "ORDER BY created_at DESC";
        }

        $params = [$userID, $userID];
        $yearFilter = " ";
        
        /* if the year is valid and not "any" we insert the year 
        for both album and song queries */
        if($year !== "any"){
            $yearFilter = "AND albums.year_released = ?";
            array_splice($params,1,0,[$year]);
            $params[] = $year;
        }

        $stmt = db()->prepare(

            " SELECT 'Album' AS item_type,
            GROUP_CONCAT(artists.name, ', ') AS artist_name,
            album_reviews.id as review_id,
            album_reviews.rating,
            album_reviews.review_text,
            album_reviews.created_at,
            album_reviews.likes

            FROM album_reviews

            JOIN albums ON album_reviews.album_id = albums.id
            JOIN album_artists ON albums.id = album_artists.album_id
            JOIN artists ON album_artists.artist_id = artists.id
            WHERE album_reviews.user_id = ? " . $yearFilter . "
            GROUP BY album_reviews.id

            UNION ALL

            SELECT 'Song' AS item_type,
            GROUP_CONCAT(artists.name, ', ') AS artist_name,
            song_reviews.id as review_id,
            song_reviews.rating,
            song_reviews.review_text,
            song_reviews.created_at,
            song_reviews.likes

            FROM song_reviews

            JOIN songs ON song_reviews.song_id = songs.id
            JOIN song_artists ON songs.id = song_artists.song_id
            JOIN artists ON song_artists.artist_id = artists.id
            LEFT JOIN albums ON songs.album_id = albums.id
            WHERE song_reviews.user_id = ? AND COALESCE(songs.year_released, albums.year_released) " . (($year !== "any") ? "= ?" : "IS NOT NULL") . "
            GROUP BY song_reviews.id

            " . $sortprompt
        );

        $stmt->execute($params);

        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $items;

    }

    protected function getRatedAlbums($userID, $sortby, $year): array{
        $sortprompt = "";
        if($sortby === "oldest"){
            $sortprompt = "ORDER BY album_reviews.created_at ASC";
        }else if($sortby === "rating"){
            $sortprompt = "ORDER BY album_reviews.rating DESC";
        }else{
            $sortprompt = "ORDER BY album_reviews.created_at DESC";
        }

        $params = [$userID];
        $yearprompt = "";
        if($year !== "any"){
            $yearprompt = "AND albums.year_released = ?";
            $params[] = $year;
        }

        $stmt = db()->prepare(

            " SELECT 'Album' AS item_type,
            GROUP_CONCAT(artists.name, ', ') AS artist_name,
            album_reviews.id as review_id,
            album_reviews.rating,
            album_reviews.review_text,
            album_reviews.created_at,
            album_reviews.likes

            FROM album_reviews

            JOIN albums ON album_reviews.album_id = albums.id
            JOIN album_artists ON albums.id = album_artists.album_id
            JOIN artists ON album_artists.artist_id = artists.id
            WHERE album_reviews.user_id = ?
            " . $yearprompt . "
            GROUP BY album_reviews.id
            " . $sortprompt
        );

        $stmt->execute($params);

        $ratedAlbums = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $ratedAlbums;

    }

    protected function getRatedSongs($userID, $sortby, $year): array{
        $sortprompt = "";
        if($sortby === "oldest"){
            $sortprompt = "ORDER BY song_reviews.created_at ASC";
        }else if($sortby === "rating"){
            $sortprompt = "ORDER BY song_reviews.rating DESC";
        }else{
            $sortprompt = "ORDER BY song_reviews.created_at DESC";
        }

        $params = [$userID];
        $yearprompt = "";
        if($year !== "any"){
            $yearprompt = "AND COALESCE(songs.year_released, albums.year_released) = ?";
            $params[] = $year;
        }

        $stmt = db()->prepare(

            " SELECT 'Song' AS item_type,
            GROUP_CONCAT(artists.name, ', ') AS artist_name,
            song_reviews.id as review_id,
            song_reviews.rating,
            song_reviews.review_text,
            song_reviews.created_at,
            song_reviews.likes

            FROM song_reviews

            JOIN songs ON song_reviews.song_id = songs.id
            JOIN song_artists ON songs.id = song_artists.song_id
            JOIN artists ON song_artists.artist_id = artists.id
            LEFT JOIN albums ON songs.album_id = albums.id
            WHERE song_reviews.user_id = ?
            " . $yearprompt . "
            GROUP BY song_reviews.id
            " . $sortprompt
        );

        $stmt->execute($params);

        $ratedSongs = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $ratedSongs;

    }
}
