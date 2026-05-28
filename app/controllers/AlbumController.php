<?php


require_once BASE_PATH . '/app/models/Album.php';

class AlbumController{

    public function show(): void
    {
    // get filter values from URL parameters
    $sortBy = $_GET['album-sort'] ?? 'recent';
    $year = $_GET['albums-year'] ?? 'any';

    $albumModel = new Album();
    $review_years = $albumModel->getYears();
    $albums = $albumModel->getAllAlbums($sortBy, $year);

    require BASE_PATH . '/app/views/albums/albums.php';
    }
}