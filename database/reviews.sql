USE final_proj;

INSERT IGNORE INTO users (username, email, password)
VALUES
    ('Yuan', 'yuan@email.com', 'yuan12345'),
    ('Romyr', 'romyr@email.com', 'romyr12345'),
    ('Angel', 'angel@email.com', 'angel12345'),
    ('JB_Aparicio', 'jbaparicio@email.com', 'jba12345');

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
    (1, 4, 4, 'It''s a good song I guess!', 0, 4),
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
    (2, 6, 1, 'I dislike this song!', 0, 2);

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
    (3, 1, 1, 'I dislike this album!', 0, 2),
    (4, 1, 3, 'I don''t get the hype', 0, 3),
    (4, 2, 4, 'It''s a good album I guess!', 0, 4),
    (2, 2, 5, 'Best album ever made!', 1, 4),
    (1, 2, 1, 'I dislike this album!', 0, 2),
    (3, 2, 3, 'I don''t get the hype', 0, 3),
    (4, 3, 4, 'It''s a good album I guess!', 0, 4),
    (2, 3, 5, 'Best album ever made!', 1, 4),
    (1, 3, 5, 'Best album ever made!', 1, 4),
    (3, 3, 3, 'I don''t get the hype', 0, 3),
    (1, 4, 4, 'It''s a good album I guess!', 0, 4),
    (4, 4, 4, 'It''s a good album I guess!', 0, 4),
    (3, 4, 5, 'Best album ever made!', 1, 4),
    (2, 4, 3, 'I don''t get the hype', 0, 3),
    (1, 5, 4, 'It''s a good album I guess!', 0, 4),
    (3, 5, 3, 'I don''t get the hype', 0, 3),
    (4, 5, 5, 'Best album ever made!', 1, 4),
    (2, 5, 3, 'I don''t get the hype', 0, 3),
    (1, 6, 5, 'Best album ever made!', 1, 4),
    (3, 6, 3, 'I don''t get the hype', 0, 3),
    (4, 6, 1, 'I dislike this album!', 0, 2),
    (2, 6, 1, 'I dislike this album!', 0, 2);