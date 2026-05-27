<?php


require_once BASE_PATH . '/app/includes/auth.php';
require_once BASE_PATH . '/app/models/Profile.php';
require_once BASE_PATH . '/app/models/Landing.php';

class LandingController
{
    public function show(): void
    {
        requireLogin();
        $userId = $_SESSION['user_id'];
        $landingModel = new Landing();
        $profileModel = new Profile();

        // run the model functions to get the data needed for the view
        $user = $profileModel->getUserInfo($userId);
        $songsReviewed = $profileModel->countUserSongReviews($userId);
        $albumsReviewed = $profileModel->countUserAlbumReviews($userId);
        $trendingSongs = $landingModel->getTrendingSongs();
        $trendingAlbums = $landingModel->getTrendingAlbums();
        $trendingSongReviews = $landingModel->getTrendingSongReviews();
        $trendingAlbumReviews = $landingModel->getTrendingAlbumReviews();
        $totalSongReviews = $landingModel->countTotalSongReviews();
        $totalAlbumReviews = $landingModel->countTotalAlbumReviews();


        // run the view
        require BASE_PATH . '/app/views/landing.php';
    }
}


?>