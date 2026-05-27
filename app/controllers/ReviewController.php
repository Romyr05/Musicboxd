<?php

require_once BASE_PATH . '/app/includes/auth.php';
require_once BASE_PATH . '/app/models/Review.php';  // review model

class ReviewController 
{
    private Review $reviewModel;

    public function __construct() {

        $this->reviewModel = new Review();

    }

    public function create(): void {

        requireLogin();
        
        $songId = $_GET['song_id'] ?? null;
        $albumId = $_GET['album_id'] ?? null;
        
        $item = null;
        $review_type = 'song';


        if ($songId) {

            $item = $this->reviewModel->getSong((int)$songId);
            $review_type = 'song';

        } elseif ($albumId) {

            $item = $this->reviewModel->getAlbum((int)$albumId);
            $review_type = 'album';

        }

        if (!$item) {

            require BASE_PATH . '/app/views/errors/404.php';
            exit;

        }

        $item['artist_name'] = $item['artist_names'] ?? 'Unknown Artist';

        $isEdit = false;
        $review = null; 

        require BASE_PATH . '/app/views/review/review.php';

    }

    public function edit(): void {

        requireLogin();
        $userId = $_SESSION['user_id'];
        
        $reviewId = $_GET['id'] ?? null;
        $review_type = $_GET['type'] ?? 'song';
        
        if (!$reviewId) {

            require BASE_PATH . '/app/views/errors/404.php';
            exit;

        }
        
        if ($review_type === 'song') {

            $review = $this->reviewModel->getSongReview($userId, (int)$reviewId);

        } else {

            $review = $this->reviewModel->getAlbumReview($userId, (int)$reviewId);

        }
        
        if (!$review) {
            
            require BASE_PATH . '/app/views/errors/404.php';
            exit;

        }

        $review['artist_name'] = $review['artist_names'] ?? 'Unknown Artist';
        $review['created_at'] = $review['date_created'];
        $review['review_id'] = $review['id'];
        
        $isEdit = true;
        $item = null; 

        require BASE_PATH . '/app/views/review/review.php';

    }

    public function store(): void {

        requireLogin();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

            header('Location: journal');
            exit;

        }

        $itemId = (int)$_POST['item_id'];
        $itemType = $_POST['item_type'] ?? 'song';
        $rating = isset($_POST['rating']) ? (int)$_POST['rating'] : null;
        $reviewText = trim($_POST['review_text'] ?? '');
        $favorited = isset($_POST['favorited']) ? 1 : 0;
        $userId = $_SESSION['user_id'];

        if (empty($reviewText)) {

            die("Review text cannot be empty.");

        }

        if (!in_array($itemType, ['song', 'album'])) {

            require BASE_PATH . '/app/views/errors/404.php';
            exit;

        }

        if ($itemType === 'song') {

            $this->reviewModel->createSongReview($userId, $itemId, $rating, $reviewText, $favorited);

        } else {

            $this->reviewModel->createAlbumReview($userId, $itemId, $rating, $reviewText, $favorited);

        }

        header('Location: /journal');
        exit;

    }

    public function update(): void {

        requireLogin();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

            header('Location: journal');
            exit;

        }

        $reviewId = (int)$_POST['review_id'];
        $itemType = $_POST['item_type'] ?? 'song';
        $actionMethod = $_POST['action_method'] ?? 'save';
        $userId = $_SESSION['user_id'];

        if (!in_array($itemType, ['song', 'album'])) {

            require BASE_PATH . '/app/views/errors/404.php';
            exit;

        }

        if ($actionMethod === 'delete') {

            if ($itemType === 'song') {

                $res = $this->reviewModel->deleteSongReview($reviewId, $userId);
                
            } else {

                $res = $this->reviewModel->deleteAlbumReview($reviewId, $userId);

            }

            if (!$res) {

                die("Delete failed.");

            }

            header('Location: journal');
            exit;

        }

        $rating = isset($_POST['rating']) ? (int)$_POST['rating'] : null;
        $reviewText = trim($_POST['review_text'] ?? '');
        $favorited = isset($_POST['favorited']) ? 1 : 0;

        if (empty($reviewText)) {

            die("Review text cannot be empty.");

        }

        if ($itemType === 'song') {

            $res = $this->reviewModel->updateSongReview($rating, $reviewText, $favorited, $reviewId, $userId);

        } else {

            $res = $this->reviewModel->updateAlbumReview($rating, $reviewText, $favorited, $reviewId, $userId);

        }

        if (!$res) {

            die("Update failed.");

        }

        header('Location: journal');
        exit;

    }
}