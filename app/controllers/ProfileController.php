<?php

// This is where the logic part of the Profile

require_once BASE_PATH . '/app/includes/auth.php';
require_once BASE_PATH . '/app/models/Profile.php';


class ProfileController{

    public function show(): void
    {
    requireLogin();

    $userId = $_SESSION['user_id'];

    $profileModel = new Profile();

    $user = $profileModel->getUserInfo($userId);
    $songsReviewed = $profileModel->countUserSongReviews($userId);
    $albumsReviewed = $profileModel->countUserAlbumReviews($userId);
    $highestRatedSongs = $profileModel->getHighestRatedSongs($userId);
    $highestRatedAlbums = $profileModel->getHighestRatedAlbums($userId);
    $recentSongReviews = $profileModel->getRecentSongReviews($userId);
    $recentAlbumReviews = $profileModel->getRecentAlbumReviews($userId);

    require BASE_PATH . '/app/views/profile/profile.php';
    }


}