USE final_proj;

INSERT IGNORE INTO users (username, email, password)
VALUES
/*
passwords
yuan12345
romyr12345
angel12345
jba12345
*/
    ('Yuan', 'yuan@email.com', '$2y$10$u/cKuA3QWYm3u.nDewpY2OvgMm5TCg0D4N75w0PsxVx5l0ughMxcW'),
    ('Romyr', 'romyr@email.com', '$2y$10$0tERpyr4tvA8qUdWTq1KBu58OWw/sPr13.8oVvz2ByQn61Cck4AAW'),
    ('Angel', 'angel@email.com', '$2y$10$GAc1nlJsLUm8ZzPk.zF4Q.m3JWhZnlKfkMmveRhGmC1lW0R0SY4Iq'),
    ('JB_Aparicio', 'jbaparicio@email.com', '$2y$10$TqK5xISlId763rkGm8WXU.jtIgHVo9uetVFk74Wr5wJlt4Y5I0ca2'),
    ('Crow', 'crow@email.com', '$2y$10$dDHUw2AfU20a5ZR9T3CAVeCUOCSuKgO4I3WIYkG4zfDQHDjh1M83i');

INSERT IGNORE INTO song_reviews (
    user_id,
    song_id,
    rating,
    review_text,
    favorited,
    likes
)
VALUES
    (1, 1, 4, 'It''s a good song I guess!', 0, 4),
    (2, 1, 5, 'Best song ever made!', 1, 4),
    (3, 1, 1, 'I dislike this song!', 0, 2),
    (4, 1, 3, 'I don''t get the hype', 0, 3),
    (4, 2, 4, 'It''s a good song I guess!', 0, 4),
    (2, 2, 5, 'Best song ever made!', 1, 4),
    (1, 2, 1, 'I dislike this song!', 0, 2),
    (3, 2, 3, 'I don''t get the hype', 0, 3),
    (4, 3, 4, 'It''s a good song I guess!', 0, 4),
    (2, 3, 5, 'Best song ever made!', 1, 4),
    (1, 3, 5, 'Best song ever made!', 1, 4),
    (3, 3, 3, 'I don''t get the hype', 0, 3),
    (1, 4, 4, 'It''s a good song I guess!', 0, 8),
    (4, 4, 4, 'It''s a good song I guess!', 0, 4),
    (3, 4, 5, 'Best song ever made!', 1, 4),
    (2, 4, 3, 'I don''t get the hype', 0, 3),
    (1, 5, 4, 'It''s a good song I guess!', 0, 4),
    (3, 5, 3, 'I don''t get the hype', 0, 3),
    (4, 5, 5, 'Best song ever made!', 1, 4),
    (2, 5, 3, 'I don''t get the hype', 0, 3),
    (1, 6, 5, 'Best song ever made!', 1, 4),
    (3, 6, 3, 'I don''t get the hype', 0, 3),
    (4, 6, 1, 'I dislike this song!', 0, 2),
    (2, 6, 1, 'I dislike this song!', 0, 2),
    (10, 2, 5, 'Lifechanging', 1, 12),
    (10, 3, 2, 'Could be better...', 0, 5);

INSERT IGNORE INTO album_reviews (
    user_id,
    album_id,
    rating,
    review_text,
    favorited,
    likes
)
VALUES
    (1, 1, 4, 'It''s a good album I guess!', 0, 4),
    (2, 1, 5, 'Best album ever made!', 1, 4),
    (3, 1, 1, 'I dislike this album!', 0, 9),
    (4, 1, 3, 'I don''t get the hype', 0, 3),
    (4, 2, 4, 'It''s a good album I guess!', 0, 4),
    (2, 2, 5, 'Best album ever made!', 1, 4),
    (1, 2, 1, 'I dislike this album!', 0, 2),
    (3, 2, 3, 'I don''t get the hype', 0, 3),
    (4, 3, 4, 'It''s a good album I guess!', 0, 7),
    (2, 3, 5, 'Best album ever made!', 1, 4),
    (1, 3, 5, 'Best album ever made!', 1, 4),
    (3, 3, 3, 'I don''t get the hype', 0, 3),
    (1, 4, 4, 'It''s a good album I guess!', 0, 4),
    (4, 4, 4, 'It''s a good album I guess!', 0, 4),
    (3, 4, 5, 'Best album ever made!', 1, 12),
    (2, 4, 3, 'I don''t get the hype', 0, 3),
    (1, 5, 4, 'It''s a good album I guess!', 0, 4),
    (3, 5, 3, 'I don''t get the hype', 0, 3),
    (4, 5, 5, 'Best album ever made!', 1, 4),
    (2, 5, 3, 'I don''t get the hype', 0, 8),
    (1, 6, 5, 'Best album ever made!', 1, 4),
    (3, 6, 3, 'I don''t get the hype', 0, 3),
    (4, 6, 1, 'I dislike this album!', 0, 2),
    (2, 6, 1, 'I dislike this album!', 0, 2),
    (10, 1, 4, 'Brings back memories!', 1, 4),
    (10, 4, 5, 'A classic banger!!!', 1, 3);