<?php
    session_start();
    if ( !isset($_SESSION["FavoriteSongs"]) ) {     
    $_SESSION["FavoriteSongs"] = array(); }
    array_push($_SESSION["FavoriteSongs"],$_GET["id"] );
    header("Location: " . $_SERVER["HTTP_REFERER"]);
?>

