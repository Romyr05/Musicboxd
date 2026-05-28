<?php

// Song Controller - Displays all available songs

require_once BASE_PATH . '/app/models/Song.php';


class SongController{

    public function show(): void
    {
    // get filter values from URL parameters
    $sortBy = $_GET['songs-sort'] ?? 'recent';
    $year = $_GET['songs-year'] ?? 'any';

    $songModel = new Song();
    $review_years = $songModel->getYears();
    $songs = $songModel->getAllSongs($sortBy, $year);

    require BASE_PATH . '/app/views/songs/songs.php';
    }
}
