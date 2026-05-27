<?php

// This is where the logic part of the Profile

require_once BASE_PATH . '/app/includes/auth.php';
require_once BASE_PATH . '/app/models/Journal.php';


class JournalController{

    public function show(): void
    {
    requireLogin();

    $userId = $_SESSION['user_id'];
    
    // get filter values from URL parameters
    $reviewType = $_GET['journal-type'] ?? 'any';
    $sortBy = $_GET['journal-sort'] ?? 'recent';
    $year = $_GET['journal-year'] ?? 'any';

    // extra filters OPTIONAL, REMOVED DUE TO TIME CRUNCH
    // $artist = $_GET['journal-artist'] ?? 'any';
    // $extra_state = $_GET['extra_filters'] ?? 'show';
    



    // too lazy to put it in the model

    $journalModel = new Journal();
    $review_years = $journalModel->getReviewDates();
    $reviews = $journalModel->getFilteredReviews($userId, $reviewType, $sortBy, $year);

    require BASE_PATH . '/app/views/journal/journal.php';
    }
}