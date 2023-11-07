<?php
include_once "../includes/config.inc.php";
session_start();

function getArtist()
{
  
        $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql    = "SELECT * FROM artists";
        $result = $pdo->query($sql);
        return $artistData = $result->fetchAll(PDO::FETCH_ASSOC);
        $pdo = null;
    
    
}

function getGenre()
{
   
        $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql    = "SELECT * FROM genres";
        $result = $pdo->query($sql);
        return $genereData = $result->fetchAll(PDO::FETCH_ASSOC);
        $pdo = null;
   
}
function printHeader()
{
    echo "<header>";
    echo "<h1>COMP 3512</h1>";
    echo "<h2>&copy Christopher Nottingham and Obayda Daoud</h2>";
    echo "<nav";
    echo "<a href='./Home.php'>Home</a>";
    echo "<a href='./SingleSong.php'>Single Song</a>";
    echo "<a href='./Favorites.php'>Favorites</a>";
    echo "<a href='./Browse-Search-Results.php'>Browse/Search Results</a>";
    echo "<a href='./aboutus.php'>About Us</a>";
    echo "</nav";
    echo "</header>";
}
function printFooter()
{
    echo "<footer class='footer' id = 'text'>COMP 3512 -001 | &copy <a href='https://github.com/Christopher-Nottingham'>&nbsp;Christopher Nottingham&nbsp;</a>  and  <a href='https://github.com/ObaydaD'> &nbsp;Obayda Daoud&nbsp; </a> |  <a href='https://github.com/Christopher-Nottingham/COMP3512-Assign1'>&nbsp;GitHub Repo&nbsp;</a></footer>";
}

function getSongs()
{
    
        $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql    = "SELECT * FROM songs";
        $result = $pdo->query($sql);
        return $songData = $result->fetchAll(PDO::FETCH_ASSOC);
    
   
    
}  


function getSongBrowseSearchResults()
{
    if (!empty($_GET['title'])) {
        $song = getAllSongsLike($_GET['title']);

        foreach ($song as $row) {
            echo "<tr>";
            echo "<td>" . $row['title'] . "</td>";
            echo "<td>" . $row['artist_name'] . "</td>";
            echo "<td>" . $row['year'] . "</td>";
            echo "<td>" . $row['genre_name'] . "</td>";
            echo "<td>" . $row['popularity'] . "</td>";
            echo "<td><a id = 'altText' href='addToFavorites.php?id=" . $row['song_id'] . "'>Favorite Me</a></td>";
            echo "<td><a id = 'altText' href='SingleSong.php?song_id=" . $row['song_id'] . "'>Click Me</a></td>";
            echo "</tr>";
        }
    } elseif (!empty($_GET['artist'])) {
        $listofartist = getAllSongsFromArtist($_GET['artist']);
        foreach ($listofartist as $row) {
            echo "<tr>";
            echo "<td>" . $row['title'] . "</td>";
            echo "<td>" . $row['artist_name'] . "</td>";
            echo "<td>" . $row['year'] . "</td>";
            echo "<td>" . $row['genre_name'] . "</td>";
            echo "<td>" . $row['popularity'] . "</td>";
            echo "<td><a id = 'altText' href='addToFavorites.php?id=" . $row['song_id'] . "'>Favorite Me</a></td>";
            echo "<td><a id = 'altText' href='SingleSong.php?song_id=" . $row['song_id'] . "'>Click Me</a></td>";
            echo "</tr>";
        }
    } elseif (!empty($_GET['year_less'])) {
        $year = getAllSongsFromYearsLessThan($_GET['year_less']);
        foreach ($year as $row) {
            echo "<tr>";
            echo "<td>" . $row['title'] . "</td>";
            echo "<td>" . $row['artist_name'] . "</td>";
            echo "<td>" . $row['year'] . "</td>";
            echo "<td>" . $row['genre_name'] . "</td>";
            echo "<td>" . $row['popularity'] . "</td>";
            echo "<td><a id = 'altText' href='addToFavorites.php?id=" . $row['song_id'] . "'>Favorite Me</a></td>";
            echo "<td><a id = 'altText' href='SingleSong.php?song_id=" . $row['song_id'] . "'>Click Me</a></td>";
            echo "</tr>";
        }
    } elseif (!empty($_GET['year_greater'])) {
        $year = getAllSongsFromYearsGreaterThan($_GET['year_greater']);
        foreach ($year as $row) {
            echo "<tr>";
            echo "<td>" . $row['title'] . "</td>";
            echo "<td>" . $row['artist_name'] . "</td>";
            echo "<td>" . $row['year'] . "</td>";
            echo "<td>" . $row['genre_name'] . "</td>";
            echo "<td>" . $row['popularity'] . "</td>";
            echo "<td><a  id = 'altText' href='addToFavorites.php?id=" . $row['song_id'] . "'>Favorite Me</a></td>";
            echo "<td><a id = 'altText' href='SingleSong.php?song_id=" . $row['song_id'] . "'>Click Me</a></td>";
            echo "</tr>";
        }
    } else {
        $songs = getAllSongInfo();
        foreach ($songs as $row) {
            echo "<tr>";
            echo "<td>" . $row['title'] . "</td>";
            echo "<td>" . $row['artist_name'] . "</td>";
            echo "<td>" . $row['year'] . "</td>";
            echo "<td>" . $row['genre_name'] . "</td>";
            echo "<td>" . $row['popularity'] . "</td>";
            echo "<td><a id = 'altText' href='addToFavorites.php?id=" . $row['song_id'] . "'>Favorite Me</a></td>";
            echo "<td><a  id = 'altText' href='SingleSong.php?song_id=" . $row['song_id'] . "'>Click Me</a></td>";
            echo "</tr>";
        }
    }
}

function getArtist_From_Song_ID($songid)
{

        $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql    = "SELECT title, year ,artist_name , a.artist_id, g.genre_name, s.genre_id, duration, bpm,  energy, danceability, liveness, valence, acousticness, speechiness, popularity
        FROM artists as a, genres as g, songs as s, types as t
        WHERE a.artist_id = s.artist_id AND s.genre_id = g.genre_id AND t.type_id = a.artist_type_id
        AND song_id = " . $songid . "";
        $result = $pdo->query($sql);
        return $ASData = $result->fetchAll(PDO::FETCH_ASSOC);
        $pdo = null;
    
    
}

function getAllSongsLike($song)
{
   
        $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT title, year ,artist_name , a.artist_id, g.genre_name, s.genre_id, duration, bpm,  energy, danceability, liveness, valence, acousticness, speechiness, popularity FROM artists as a, genres as g, songs as s, types as t WHERE a.artist_id = s.artist_id AND s.genre_id = g.genre_id AND t.type_id = a.artist_type_id AND title LIKE '%" . $song . "%'";
        
        $result = $pdo->query($sql);
        return $ASData = $result->fetchAll(PDO::FETCH_ASSOC);
        $pdo = null;
   
    
}
function getAllSongsFromYearsGreaterThan($year)
{
    
    
        $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql    = "SELECT song_id ,title, year ,artist_name , a.artist_id, g.genre_name, s.genre_id, duration, bpm,  energy, danceability, liveness, valence, acousticness, speechiness, popularity
                FROM artists as a, genres as g, songs as s, types as t
                WHERE a.artist_id = s.artist_id AND s.genre_id = g.genre_id AND t.type_id = a.artist_type_id AND year > " . $year . "";
        $result = $pdo->query($sql);
        return $ASData = $result->fetchAll(PDO::FETCH_ASSOC);
          $pdo = null;
    
    
}

function getAllSongsFromYearsLessThan($year)
{
   
        $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql    = "SELECT song_id ,title, year ,artist_name , a.artist_id, g.genre_name, s.genre_id, duration, bpm,  energy, danceability, liveness, valence, acousticness, speechiness, popularity
                FROM artists as a, genres as g, songs as s, types as t
                WHERE a.artist_id = s.artist_id AND s.genre_id = g.genre_id AND t.type_id = a.artist_type_id AND year < " . $year . "";
        $result = $pdo->query($sql);
        return $ASData = $result->fetchAll(PDO::FETCH_ASSOC);
        //  $pdo = null;
    
}

function getAllSongsFromGenereLike($genere)
{
   
        $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT title, year ,artist_name , a.artist_id, g.genre_name, s.genre_id, duration, bpm,  energy, danceability, liveness, valence, acousticness, speechiness, popularity FROM artists as a, genres as g, songs as s, types as t WHERE a.artist_id = s.artist_id AND s.genre_id = g.genre_id AND t.type_id = a.artist_type_id AND genre_name = '" . $genere . "'";
        
        $result = $pdo->query($sql);
        return $ASData = $result->fetchAll(PDO::FETCH_ASSOC);
        $pdo = null;
   
}

function getAllSongsFromArtist($artist)
{
   
        $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT title, year ,artist_name , a.artist_id, g.genre_name, s.genre_id, duration, bpm,  energy, danceability, liveness, valence, acousticness, speechiness, popularity FROM artists as a, genres as g, songs as s, types as t WHERE a.artist_id = s.artist_id AND s.genre_id = g.genre_id AND t.type_id = a.artist_type_id AND artist_name = '" . $artist . "'";
        
        $result = $pdo->query($sql);
        return $ASData = $result->fetchAll(PDO::FETCH_ASSOC);
        $pdo = null;
  
    
}



function getAllSongInfo(){
    

        
        
        
        $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql    = "SELECT song_id ,title, year ,artist_name , a.artist_id, g.genre_name, s.genre_id, duration, bpm,  energy, danceability, liveness, valence, acousticness, speechiness, popularity
        FROM artists as a, genres as g, songs as s, types as t
        WHERE a.artist_id = s.artist_id AND s.genre_id = g.genre_id AND t.type_id = a.artist_type_id";
       
        $result    = $pdo->query($sql);
        $finalData = $result->fetchAll(PDO::FETCH_ASSOC);
        
        
        
        if (empty($finalData)) {
            return "No results found, database error!";
        } else {
            return $finalData;
        }
        $pdo = null;
    

}

function getAllSpecificSongData($id){
    $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql    = "SELECT song_id ,title, year ,artist_name , a.artist_id, g.genre_name, s.genre_id, duration, bpm,  energy, danceability, liveness, valence, acousticness, speechiness, popularity
        FROM artists as a, genres as g, songs as s, types as t
        WHERE a.artist_id = s.artist_id AND s.genre_id = g.genre_id AND t.type_id = a.artist_type_id AND s.song_id=".$id;
        $result    = $pdo->query($sql);
        $finalData = $result->fetchAll(PDO::FETCH_ASSOC);
        if (empty($finalData)) {
            return "No results found, database error!";
        } else {
            return $finalData;
        }
        $pdo = null;
}















// // Top Generes

function getTopGenres()
{
    // Database connection
    $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // SQL query to get top genres
    $sql = "SELECT genres.genre_name, COUNT(songs.song_id) AS song_count
            FROM genres
            INNER JOIN songs ON genres.genre_id = songs.genre_id
            GROUP BY genres.genre_name
            ORDER BY song_count DESC
            LIMIT 10";
    
    $result = $db->query($sql);
    
    
    $result    = $pdo->query($sql);
    $finalData = $result->fetchAll(PDO::FETCH_ASSOC);
    
    
    
    if (empty($finalData)) {
        return "No results found, database error!";
    } else {
        return $finalData;
    }
    $pdo = null;
    
    
}




// // top Artist

// // Function to get the top artist
function getTopArtist()
{
    // Database connection
    $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql        = "SELECT artists.artist_id, artists.artist_name, COUNT(songs.artist_id) AS song_count
    FROM songs
    INNER JOIN artists ON songs.artist_id = artists.artist_id
    GROUP BY artists.artist_id, artists.artist_name
    ORDER BY song_count DESC";
  $result    = $pdo->query($sql);
  $finalData = $result->fetchAll(PDO::FETCH_ASSOC);
  
  
  
  if (empty($finalData)) {
      return "No results found, database error!";
  } else {
      return $finalData;
  }
  $pdo = null; 
}



// // Most popular songs 


function getMostPopularSongs()
{
    // Database connection
    $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // SQL query to get the most popular songs
    $sql = "SELECT artists.artist_name, COUNT(songs.song_id) AS song_count
            FROM artists
            INNER JOIN songs ON artists.artist_id = songs.artist_id
            GROUP BY artists.artist_name
            ORDER BY song_count DESC";
    
    
    
    $result    = $pdo->query($sql);
    $finalData = $result->fetchAll(PDO::FETCH_ASSOC);
    
    
    
    if (empty($finalData)) {
        return "No results found, database error!";
    } else {
        return $finalData;
    }
    $pdo = null;
    
    
}



// //ONE hit wonders

function getOneHitWondersSongs()
{
    // Database connection
    $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // SQL query to get one-hit wonders songs
    $sql = "SELECT songs.title, artists.artist_name, songs.popularity
            FROM songs
            INNER JOIN artists ON songs.artist_id = artists.artist_id
            WHERE songs.artist_id IN (
                SELECT artist_id
                FROM songs
                GROUP BY artist_id
                HAVING COUNT(*) = 1
            )
            ORDER BY songs.popularity DESC";
    
    
    $result = $pdo->query($sql);
    $finalData = $result->fetchAll(PDO::FETCH_ASSOC);
    
    
    
    if (empty($finalData)) {
        return "No results found, database error!";
    } else {
        return $finalData;
    }
    $pdo = null;
    
    
}




// // Longest Acoustic Song

function getLongestAcousticSongs()
{
    $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // SQL query to get longest acoustic songs
    $sql = "SELECT title FROM songs
            WHERE acousticness > 40
            ORDER BY duration";
    
 
    
    
    $result = $pdo->query($sql);
    $finalData = $result->fetchAll(PDO::FETCH_ASSOC);
    
    
    
    if (empty($finalData)) {
        return "No results found, database error!";
    } else {
        return $finalData;
    }
    $pdo = null;
    
    
}





// // At the club

function getAtTheClubSongs()
{
    // Database connection
    $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // SQL query to get songs for "At The Club"
    $sql = "SELECT songs.title FROM songs
            WHERE danceability > 85
            ORDER BY ABS(danceability*1.6+energy*1.4) DESC";
    
    $result = $db->query($sql);
    
    
    $finalData = $result->fetchAll(PDO::FETCH_ASSOC);
    
    
    
    if (empty($finalData)) {
        return "No results found, database error!";
    } else {
        return $finalData;
    }
    $pdo = null;
    
    
}




// // Running

function getRunningSongs()
{
    $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // SQL query to get running songs
    $sql = "SELECT title FROM songs
            WHERE bpm BETWEEN 120 AND 125
            ORDER BY ABS(energy * 1.3 + valence * 1.6) DESC";
    
    $result = $db->query($sql);
    
    
    $finalData = $result->fetchAll(PDO::FETCH_ASSOC);
    
    
    
    if (empty($finalData)) {
        return "No results found, database error!";
    } else {
        return $finalData;
    }
    $pdo = null;
    
    
}






// Studying

function getStudyingSongs()
{
    // Database connection
    $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // SQL query to get studying songs
    $sql = "SELECT title FROM songs
            WHERE bpm BETWEEN 100 AND 115
            AND speechiness BETWEEN 1 AND 20
            ORDER BY ABS((acousticness * 0.8) + (100-speechiness) + (100-valence)) DESC";
    
    $result = $db->query($sql);
    
    

    $finalData = $result->fetchAll(PDO::FETCH_ASSOC);
    
    
    
    if (empty($finalData)) {
        return "No results found, database error!";
    } else {
        return $finalData;
    }
    $pdo = null;
    
    
}

?>