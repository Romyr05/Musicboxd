<?php 

require_once BASE_PATH . '/app/config/database.php';


class Profile {

    # this gets the user information (id,username,email and created_at)
    public function getUserInfo($userID) : ?object{
        $stmt = db()->prepare(

            "SELECT id,username,email, created_at
            FROM users
            WHERE id = ?
            LIMIT 1
            "
        );
        
        $stmt->execute([$userID]);

        $user_info = $stmt->fetch();

        return $user_info ?: null;
    }


    public function countUserSongReviews($userID): int{
        $stmt = db()->prepare(

            "SELECT COUNT(*) 
            FROM song_reviews
            WHERE user_id = ?"

        );

        $stmt->execute([$userID]);

        $count_users_songs = $stmt->fetchColumn();

        return (int) $count_users_songs;
    }

    public function countUserAlbumReviews($userID): int{
        $stmt = db()->prepare(

            "SELECT COUNT(*) 
            FROM album_reviews
            WHERE user_id = ?"

        );

        $stmt->execute([$userID]);

        $count_users_albums = $stmt->fetchColumn();

        return (int) $count_users_albums;
    }



    public function getHighestRatedSongs($userID): array{
        $stmt = db()->prepare(

        # renamed since PDO uses the .name and .title if used as literal name and title
            "SELECT songs.title AS song_title, 
            artists.name AS artist_name, 
            song_reviews.rating,
            song_reviews.review_text,
            song_reviews.created_at,
            song_reviews.likes

            FROM song_reviews

            JOIN songs ON song_reviews.song_id = songs.id
            JOIN song_artists ON song_artists.song_id = songs.id
            JOIN artists ON artists.id = song_artists.artist_id

            WHERE song_reviews.user_id = ?
            ORDER BY song_reviews.rating DESC, song_reviews.created_at DESC  -- if same then by created
            
            LIMIT 2

            "


        );

        $stmt->execute([$userID]);

        $highestRatedSongs = $stmt->fetchAll();

        return $highestRatedSongs;


    }


    public function getHighestRatedAlbums($userID): array{
        $stmt = db()->prepare(

            " SELECT albums.title AS album_title,
            artists.name AS artist_name,
            album_reviews.rating,
            album_reviews.review_text,
            album_reviews.created_at,
            album_reviews.likes

            FROM album_reviews

            JOIN albums ON album_reviews.album_id = albums.id
            JOIN album_artists ON albums.id = album_artists.album_id
            JOIN artists ON album_artists.artist_id = artists.id

            WHERE album_reviews.user_id = ?
            ORDER BY album_reviews.rating DESC, album_reviews.created_at DESC

            LIMIT 2

            "
        );

        $stmt->execute([$userID]);

        $highestRatedAlbums = $stmt->fetchAll();

        return $highestRatedAlbums;


    }


    public function getRecentSongReviews($userID) : array{
        $stmt = db()->prepare(
            "SELECT
                songs.title AS song_title,
                artists.name AS artist_name,
                song_reviews.rating,
                song_reviews.review_text,
                song_reviews.created_at,
                song_reviews.likes
            FROM song_reviews

            JOIN songs ON song_reviews.song_id = songs.id
            JOIN song_artists ON songs.id = song_artists.song_id
            JOIN artists ON song_artists.artist_id = artists.id

            WHERE song_reviews.user_id = ?
            ORDER BY song_reviews.created_at DESC

            LIMIT 2"
        );

        $stmt->execute([$userID]);

        $RecentlyRatedSongs = $stmt->fetchAll();

        return $RecentlyRatedSongs;

    }


    public function getRecentAlbumReviews($userID): array{

            $stmt = db()->prepare(
                "SELECT
                    albums.title AS album_title,
                    artists.name AS artist_name,
                    album_reviews.rating,
                    album_reviews.review_text,
                    album_reviews.created_at,
                    album_reviews.likes
                FROM album_reviews

                JOIN albums ON album_reviews.album_id = albums.id
                JOIN album_artists ON albums.id = album_artists.album_id
                JOIN artists ON album_artists.artist_id = artists.id


                WHERE album_reviews.user_id = ?
                ORDER BY album_reviews.created_at DESC

                LIMIT 2"
        );

        $stmt->execute([$userID]);

        $RecentlyRatedAlbums = $stmt->fetchAll();

        return $RecentlyRatedAlbums;
    }

}







?>
