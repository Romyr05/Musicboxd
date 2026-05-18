-- Seeding
PRAGMA foreign_keys = ON;

-- Artists
INSERT OR IGNORE INTO artists (spotify_artist_id, name, genre) VALUES
    ('seed_artist_al_james', 'Al James', 'Pinoy Hip-Hop'),
    ('seed_artist_hev_abi', 'Hev Abi', 'Pinoy Hip-Hop'),
    ('seed_artist_parokya_ni_edgar', 'Parokya ni Edgar', 'OPM Rock'),
    ('seed_artist_shanti_dope', 'Shanti Dope', 'Pinoy Hip-Hop'),
    ('seed_artist_sassa_gurl', 'Sassa Gurl', 'Pop');

-- Albums 
INSERT OR IGNORE INTO albums (spotify_album_id, title, year_released, album_cover_url, spotify_url, genre) VALUES
    ('seed_album_para_sa_streets', 'Para Sa Streets', 2023, '', 'https://open.spotify.com/album/62G53UzsyGd1updwIfyXLq', 'Pinoy Hip-Hop'),
    ('seed_album_the_ordertaker', 'The Ordertaker', 2014, '', 'https://open.spotify.com/track/3AAszpH4cjFE6okQAYUrtO', 'OPM Rock'),
    ('seed_album_materyal', 'Materyal', 2017, '', 'https://open.spotify.com/album/5PPETYQBNZUJgUzHAVx6gx', 'Pinoy Hip-Hop');

-- Album artists
INSERT OR IGNORE INTO album_artists (album_id, artist_id)
SELECT albums.id, artists.id
FROM albums, artists
WHERE albums.spotify_album_id = 'seed_album_para_sa_streets'
  AND artists.spotify_artist_id = 'seed_artist_hev_abi';

INSERT OR IGNORE INTO album_artists (album_id, artist_id)
SELECT albums.id, artists.id
FROM albums, artists
WHERE albums.spotify_album_id = 'seed_album_the_ordertaker'
  AND artists.spotify_artist_id = 'seed_artist_parokya_ni_edgar';

INSERT OR IGNORE INTO album_artists (album_id, artist_id)
SELECT albums.id, artists.id
FROM albums, artists
WHERE albums.spotify_album_id = 'seed_album_materyal'
  AND artists.spotify_artist_id = 'seed_artist_shanti_dope';

-- Songs that belong to album 
INSERT OR IGNORE INTO songs (spotify_track_id, album_id, title, spotify_url, genre)
SELECT 'seed_track_para_sa_streets', albums.id, 'Para Sa Streets', 'https://open.spotify.com/track/0szRYVD2MwFzQMs58PT1Ec', 'Pinoy Hip-Hop'
FROM albums
WHERE albums.spotify_album_id = 'seed_album_para_sa_streets';

INSERT OR IGNORE INTO songs (spotify_track_id, album_id, title, spotify_url, genre)
SELECT 'seed_track_the_ordertaker', albums.id, 'The Ordertaker', 'https://open.spotify.com/track/3AAszpH4cjFE6okQAYUrtO', 'OPM Rock'
FROM albums
WHERE albums.spotify_album_id = 'seed_album_the_ordertaker';

INSERT OR IGNORE INTO songs (spotify_track_id, album_id, title, spotify_url, genre)
SELECT 'seed_track_nadarang', albums.id, 'Nadarang', 'https://open.spotify.com/track/0GV5o55wGdk8rt0q8cVGVZ', 'Pinoy Hip-Hop'
FROM albums
WHERE albums.spotify_album_id = 'seed_album_materyal';

-- Standalone singles with no album_id
INSERT OR IGNORE INTO songs (spotify_track_id, album_id, title, spotify_url, genre) VALUES
    ('seed_track_pa_umaga', NULL, 'Pa-Umaga', 'https://open.spotify.com/track/3U8MbjNAP56IrzpbEFn1qN', 'Pinoy Hip-Hop'),
    ('seed_track_maria_hiwaga', NULL, 'Maria Hiwaga', 'https://open.spotify.com/track/7rRpt0FcGdDxyhiFcSlswH', 'Pop');

-- Song artists
INSERT OR IGNORE INTO song_artists (song_id, artist_id)
SELECT songs.id, artists.id
FROM songs, artists
WHERE songs.spotify_track_id = 'seed_track_pa_umaga'
  AND artists.spotify_artist_id = 'seed_artist_al_james';

INSERT OR IGNORE INTO song_artists (song_id, artist_id)
SELECT songs.id, artists.id
FROM songs, artists
WHERE songs.spotify_track_id = 'seed_track_para_sa_streets'
  AND artists.spotify_artist_id = 'seed_artist_hev_abi';

INSERT OR IGNORE INTO song_artists (song_id, artist_id)
SELECT songs.id, artists.id
FROM songs, artists
WHERE songs.spotify_track_id = 'seed_track_the_ordertaker'
  AND artists.spotify_artist_id = 'seed_artist_parokya_ni_edgar';

INSERT OR IGNORE INTO song_artists (song_id, artist_id)
SELECT songs.id, artists.id
FROM songs, artists
WHERE songs.spotify_track_id = 'seed_track_nadarang'
  AND artists.spotify_artist_id = 'seed_artist_shanti_dope';

INSERT OR IGNORE INTO song_artists (song_id, artist_id)
SELECT songs.id, artists.id
FROM songs, artists
WHERE songs.spotify_track_id = 'seed_track_maria_hiwaga'
  AND artists.spotify_artist_id = 'seed_artist_sassa_gurl';