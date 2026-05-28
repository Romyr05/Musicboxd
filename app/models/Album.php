<?php

require_once BASE_PATH . '/app/config/database.php';


class Album {

    public function getYears(): array{
        $stmt = db()->prepare(

            " SELECT DISTINCT year_released 
            FROM albums
            WHERE year_released IS NOT NULL
            ORDER BY year_released DESC
            " 
        );

        $stmt->execute();
        $years = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $years;
    }

    public function getAllAlbums($sortBy, $year): array{
        $sortprompt = "";
        if($sortBy === "oldest"){
            $sortprompt = "ORDER BY albums.year_released ASC";
        }else if($sortBy === "title"){
            $sortprompt = "ORDER BY albums.title ASC";
        }else{
            $sortprompt = "ORDER BY albums.year_released DESC";
        }

        $params = [];
        $yearprompt = "";
        if($year !== "any"){
            $yearprompt = "WHERE albums.year_released = ?";
            $params[] = $year;
        }

        $stmt = db()->prepare(

            " SELECT DISTINCT
            albums.id,
            albums.title as album_title,
            albums.year_released,
            albums.genre,
            artists.name AS artist_name

            FROM albums

            JOIN album_artists ON albums.id = album_artists.album_id
            JOIN artists ON album_artists.artist_id = artists.id
            " . $yearprompt . "
            " . $sortprompt
        );

        $stmt->execute($params);

        $albums = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $albums;

    }
}
