-- Set up purposes only
CREATE DATABASE IF NOT EXISTS final_proj
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE final_proj;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    -- Index for users
    INDEX idx_users_username (username),
    INDEX idx_users_email (email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;-- mysql engine for relational database and allow modern text and the unicode (case insensitive)

CREATE TABLE IF NOT EXISTS artists (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    genre VARCHAR(100), 
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    -- Index for artists
    INDEX idx_artists_name (name),
    INDEX idx_artists_genre (genre)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE IF NOT EXISTS albums (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    year_released INT,
    album_cover_url TEXT,
    genre VARCHAR(100),
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    -- INdex for albums
    INDEX idx_albums_title (title),
    INDEX idx_albums_genre (genre),
    INDEX idx_albums_year_released (year_released)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci; 


CREATE TABLE IF NOT EXISTS album_artists (
    id INT AUTO_INCREMENT PRIMARY KEY,
    album_id INT NOT NULL,
    artist_id INT NOT NULL,
    CONSTRAINT fk_album_artists_album
        FOREIGN KEY (album_id) REFERENCES albums(id) ON DELETE CASCADE,
    CONSTRAINT fk_album_artists_artist
        FOREIGN KEY (artist_id) REFERENCES artists(id) ON DELETE CASCADE,
    UNIQUE KEY uq_album_artists_album_artist (album_id, artist_id), -- artist cant duplicate in the album

    -- Index for albums_artists
    INDEX idx_album_artists_album_id (album_id),
    INDEX idx_album_artists_artist_id (artist_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS songs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    album_id INT NULL,
    title VARCHAR(255) NOT NULL,
    genre VARCHAR(100),
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    favorites INT DEFAULT 0,
    CONSTRAINT fk_songs_album
        FOREIGN KEY (album_id) REFERENCES albums(id) ON DELETE SET NULL,

    -- index for songs
    INDEX idx_songs_title (title),
    INDEX idx_songs_genre (genre),
    INDEX idx_songs_album_id (album_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS song_artists (
    id INT AUTO_INCREMENT PRIMARY KEY,
    song_id INT NOT NULL,
    artist_id INT NOT NULL,

    CONSTRAINT fk_song_artists_song
        FOREIGN KEY (song_id) REFERENCES songs(id) ON DELETE CASCADE,
    CONSTRAINT fk_song_artists_artist
        FOREIGN KEY (artist_id) REFERENCES artists(id) ON DELETE CASCADE,
    UNIQUE KEY uq_song_artists_song_artist (song_id, artist_id), -- artist cannot duplicate in song

    -- index 
    INDEX idx_song_artists_song_id (song_id),
    INDEX idx_song_artists_artist_id (artist_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS song_reviews (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    song_id INT NOT NULL,
    rating INT NOT NULL,
    review_text TEXT,
    favorited TINYINT(1) NOT NULL DEFAULT 0,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    likes INT NOT NULL DEFAULT 0,

    CONSTRAINT chk_song_reviews_rating CHECK (rating BETWEEN 1 AND 5),
    CONSTRAINT chk_song_reviews_favorited CHECK (favorited IN (0, 1)),
    CONSTRAINT fk_song_reviews_user
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    CONSTRAINT fk_song_reviews_song
        FOREIGN KEY (song_id) REFERENCES songs(id) ON DELETE CASCADE,
    UNIQUE KEY uq_song_reviews_user_song (user_id, song_id), -- allow only that user to that song_id

    -- Index for song_reviews
    INDEX idx_song_reviews_user_id (user_id),
    INDEX idx_song_reviews_song_id (song_id),
    INDEX idx_song_reviews_created_at (created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS album_reviews (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    album_id INT NOt NULL,
    rating INT NOT NULL,
    review_text TEXT,
    favorited TINYINT(1) NOT NULL DEFAULT 0,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    likes INT NOT NULL DEFAULT 0,
    
    CONSTRAINT chk_album_reviews_rating CHECK (rating BETWEEN 1 AND 5),
    CONSTRAINT chk_album_reviews_favorited CHECK (favorited IN (0, 1)),
    CONSTRAINT fk_album_reviews_user
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    CONSTRAINT fk_album_reviews_album
        FOREIGN KEY (album_id) REFERENCES albums(id) ON DELETE CASCADE,
    UNIQUE KEY uq_album_reviews_user_album (user_id, album_id), -- Allow only one user to one album

    -- Index for the album_reviews
    INDEX idx_album_reviews_user_id (user_id),
    INDEX idx_album_reviews_album_id (album_id),
    INDEX idx_album_reviews_created_at (created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
