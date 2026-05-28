<?php

// This is where the logic part of the Profile

require_once BASE_PATH . '/app/includes/auth.php';
require_once BASE_PATH . '/app/models/Profile.php';


class ProfileController
{

    public function show(): void
    {
        requireLogin();

        $userId = $_SESSION['user_id'];

        $profileModel = new Profile();

        $user = $profileModel->getUserInfo($userId);
        $songsReviewed = $profileModel->countUserSongReviews($userId);
        $albumsReviewed = $profileModel->countUserAlbumReviews($userId);
        $highestRatedSongs = $profileModel->getHighestRatedSongs($userId, 2);
        $highestRatedAlbums = $profileModel->getHighestRatedAlbums($userId, 2);
        $recentSongReviews = $profileModel->getRecentSongReviews($userId, 2);
        $recentAlbumReviews = $profileModel->getRecentAlbumReviews($userId, 2);

        require BASE_PATH . '/app/views/profile/profile.php';
    }


}