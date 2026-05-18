PRAGMA foreign_keys = ON;  --to on foreign keys in sqlite


-- FOR USERS
CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY key autoincrement, 
    username TEXT NOT NULL UNIQUE,
    email TEXT NOT NULL UNIQUE,
    password TEXT NOT NULL,
    created_at TEXT NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TEXT NOT NULL DEFAULT CURRENT_TIMESTAMP
);
-- Users Index
CREATE INDEX IF NOT EXISTS idx_users_username ON users(username);
CREATE INDEX IF NOT EXISTS idx_users_email ON users(email);


--FOR ARTIST
CREATE TABLE IF NOT EXISTS artist (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    spotify_artist_id TEXT UNIQUE,  -- text string
    name TEXT NOT NULL,
    genre TEXT,
    created_at TEXT NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TEXT NOT NULL DEFAULT CURRENT_TIMESTAMP
);

-- Artist Index
CREATE INDEX IF NOT EXISTS idx_artist_name ON artist(name);
CREATE INDEX IF NOT EXISTS idx_artist_genre ON artist(genre);


CREATE TABLE IF NOT EXISTS albums (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    spotify_album_id TEXT UNIQUE ,
    title TEXT NOT NULL,
    year_released INTEGER,
    album_cover_url TEXT,
    spotify_url TEXT,
    genre TEXT,
    created_at TEXT NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TEXT NOT NULL DEFAULT CURRENT_TIMESTAMP
);

-- Albums index
CREATE INDEX IF NOT EXISTS idx_albums_title ON albums(title);
CREATE INDEX IF NOT EXISTS idx_albums_genre ON albums(genre);
CREATE INDEX IF NOT EXISTS idx_albums_year_released ON albums(year_released);


CREATE TABLE IF NOT EXISTS album_artists(
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    album_id integer not null,   
    artist_id integer not null,
    FOREIGN KEY (album_id) REFERENCES albums(id) ON DELETE CASCADE,
    FOREIGN KEY (artist_id) REFERENCES artist(id) ON DELETE CASCADE,
    UNIQUE (album_id, artist_id) --prevent same artists on same album
);

--Album artists index
CREATE INDEX IF NOT EXISTS idx_album_artists_album_id ON album_artists(album_id);
CREATE INDEX IF NOT EXISTS idx_album_artists_artist_id ON album_artists(artist_id);


CREATE TABLE IF NOT EXISTS songs (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    spotify_track_id TEXT UNIQUE,
    album_id INTEGER,
    title TEXT NOT NULL,
    spotify_url TEXT,
    genre TEXT,
    created_at TEXT NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TEXT NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (album_id) REFERENCES albums(id) ON DELETE SET NULL
);

-- songs index
CREATE INDEX IF NOT EXISTS idx_songs_title ON songs(title);
CREATE INDEX IF NOT EXISTS idx_songs_genre ON songs(genre);
CREATE INDEX IF NOT EXISTS idx_songs_album_id ON songs(album_id);


CREATE TABLE IF NOT EXISTS song_artists (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    song_id INTEGER NOT NULL,
    artist_id INTEGER NOT NULL,
    FOREIGN KEY (song_id) REFERENCES songs(id) ON DELETE CASCADE,
    FOREIGN KEY (artist_id) REFERENCES artist(id) ON DELETE CASCADE,
    UNIQUE (song_id, artist_id)  -- limits duplication of the same artist on that song
);

-- song artists index
CREATE INDEX IF NOT EXISTS idx_song_artists_song_id ON song_artists(song_id);
CREATE INDEX IF NOT EXISTS idx_song_artists_artist_id ON song_artists(artist_id);

CREATE TABLE IF NOT EXISTS song_reviews (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    user_id INTEGER NOT NULL,
    song_id INTEGER NOT NULL,
    rating INTEGER NOT NULL CHECK (rating BETWEEN 1 AND 5),   --Checks if between 1 to 5
    review_text TEXT,
    favorited INTEGER NOT NULL DEFAULT 0 CHECK (favorited IN (0, 1)),  -- Checks if boolean (1 -> T, 0 -> F)
    created_at TEXT NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TEXT NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,  
    FOREIGN KEY (song_id) REFERENCES songs(id) ON DELETE CASCADE,
    UNIQUE (user_id, song_id)  -- user can only have one review on that song
);

-- song reviews index
CREATE INDEX IF NOT EXISTS idx_song_reviews_user_id ON song_reviews(user_id);
CREATE INDEX IF NOT EXISTS idx_song_reviews_song_id ON song_reviews(song_id);
CREATE INDEX IF NOT EXISTS idx_song_reviews_created_at ON song_reviews(created_at);


CREATE TABLE IF NOT EXISTS album_reviews (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    user_id INTEGER NOT NULL,
    album_id INTEGER NULL,
    rating INTEGER NOT NULL CHECK (rating BETWEEN 1 AND 5),
    review_text TEXT,
    favorited INTEGER NOT NULL DEFAULT 0 CHECK (favorited IN (0, 1)),
    created_at TEXT NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TEXT NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (album_id) REFERENCES albums(id) ON DELETE CASCADE,
    UNIQUE (user_id, album_id)   -- user can only have one review on that album
);

-- album reviews index

CREATE INDEX IF NOT EXISTS idx_album_reviews_user_id ON album_reviews(user_id);
CREATE INDEX IF NOT EXISTS idx_album_reviews_album_id ON album_reviews(album_id);
CREATE INDEX IF NOT EXISTS idx_album_reviews_created_at ON album_reviews(created_at);












