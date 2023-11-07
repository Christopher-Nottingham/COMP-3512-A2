<?php
require_once "../includes/config.inc.php";
require_once "../includes/helperfiles.php";
// Start the session to access the favorites list

session_start();
// Initialize the favorites array if it doesn't exist
if (!isset($_SESSION['FavoriteSongs'])) {
    $_SESSION['FavoriteSongs'] = array();
}

// Function to remove a song from the favorites list
function removeFromFavorites($songId) {
    if (($key = array_search($songId, $_SESSION['FavoriteSongs'])) !== false) {
        unset($_SESSION['FavoriteSongs'][$key]);
    }
}

// Function to clear all favorites
if (isset($_GET['clear'])) {
    $_SESSION['FavoriteSongs'] = array();
}

// Check if a song should be removed from favorites
if (isset($_GET['remove'])) {
    $songToRemove = $_GET['remove'];
    removeFromFavorites($songToRemove);
}



?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../styling_files/style.css">
    <title>View Favorites</title>
</head>
<body>
 
<header>
     <div class="header"><nav class="navigation">
        <a id="white" href="Home.php">Home</a>&nbsp;
        <a id="white" href="Favorites.php">Favorites</a>    &nbsp;
        <a id="white" href="Browse-Search-Results.php">Browse/Search Results</a>&nbsp;
    <a id="white" href="Search.php">Search</a>    &nbsp;
    <a  id="white" href="aboutus.php">About Us</a>
    </nav></div>
</header>

    <div class="section">
    <?php 

print_r($_SESSION['FavoriteSongs']);

             ?>
        <h2>View Favorites</h2>
        <table>
            <tr>
                <th>Title</th>
                <th>Artist</th>
                <th>Year</th>
                <th>Genre</th>
                <th>Popularity</th>
                <th>Actions</th>
            </tr>

            <?php
            


            foreach($_SESSION['FavoriteSongs'] as $song){
                

           
            $songDetails = getAllSpecificSongData($song);
           
          
             echo "<tr>";
                 echo "<td>" . substr($songDetails['title'], 0, 25);
                if (strlen($songDetails['title']) > 25) {
                     echo "&hellip;";
                 }
                 echo "</td>";
                echo "<td id='altText'>" . $songDetails['artist_name'] . "</td>";
                echo "<td>" . $songDetails['year'] . "</td>";
                echo "<td>" . $songDetails['genre_name'] . "</td>";
                echo "<td>" . $songDetails['popularity'] . "</td>";
                echo "<td><a href='SingleSong.php?song_id=".$i."'>Remove</a></td>";
                echo "<td><a href='ViewFavoritesPage.php?remove=".$i."'>Remove</a></td>";
                echo "</tr>";
            }
            
             

               
            
            ?>

         </table>
         <br><a id="altText" href='ViewFavoritesPage.php?clear=1'>Remove All</a>
        <?php 
        printFooter();
        ?>
    </div>

</body>
</html>
