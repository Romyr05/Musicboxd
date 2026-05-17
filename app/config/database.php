<?php

function db(): PDO{  //php data object (for security and switching database purposes)
    $databasePath = __DIR__ . '/../../database/database.sqlite';

    //PDO ERROR HANDLING, CONNECTION AND FETCHING
    $pdo = new PDO('sqlite' . databasePath);  
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $pdo->exec('PRAGMA foreign_key = ON');  //Foreign key on
}