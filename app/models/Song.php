<?php

require_once BASE_PATH . '/app/config/database.php';


class Song {

    public function getYears(): array{
        $stmt = db()->prepare(

            " SELECT DISTINCT year_released 
            FROM songs
            WHERE year_released IS NOT NULL
            ORDER BY year_released DESC
            " 
        );

        $stmt->execute();
        $years = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $years;
    }

    public function getAllSongs($sortBy, $year): array{
        $sortprompt = "";
        if($sortBy === "oldest"){
            $sortprompt = "ORDER BY songs.year_released ASC";
        }else if($sortBy === "title"){
            $sortprompt = "ORDER BY songs.title ASC";
        }else{
            $sortprompt = "ORDER BY songs.year_released DESC";
        }

        $params = [];
        $yearprompt = "";
        if($year !== "any"){
            $yearprompt = "WHERE songs.year_released = ?";
            $params[] = $year;
        }

        $stmt = db()->prepare(

            " SELECT DISTINCT
            songs.id,
            songs.title as song_title,
            albums.title as album_title,
            songs.year_released,
            songs.genre,
            GROUP_CONCAT(artists.name, ', ') AS artist_name

            FROM songs

            JOIN song_artists ON songs.id = song_artists.song_id
            JOIN artists ON song_artists.artist_id = artists.id
            LEFT JOIN albums ON songs.album_id = albums.id
            " . $yearprompt . "
            GROUP BY songs.id
            " . $sortprompt
        );

        $stmt->execute($params);

        $songs = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $songs;

    }
}
