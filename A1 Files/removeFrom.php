<?php
if ( !isset($_SESSION["FavoriteSongs"]) ) {
    $_SESSION["FavoritesSongs"] = []; 
    header("Location: " . $_SERVER["HTTP_REFERER"]);
}

$key = array_search($songid,$_SESSION["FavoriteSongs"]);
unset($_SESSION["FavoritesSongs"][$key]); 


header("Location: " . $_SERVER["HTTP_REFERER"]);

?>