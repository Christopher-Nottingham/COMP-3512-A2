<?php 
require_once "../includes/config.inc.php";
require_once "../includes/helperfiles.php";
?>


<html>
    <head>
<title>Home Page</title>
<link rel="stylesheet" href="../styling_files/style.css">

    </head>
    

    <body>
 
    <header>
     <div class="header"><nav class="navigation">
        <a id="white" href="./Home.php">Home</a>&nbsp;
        <a id="white" href="./Favorites.php">Favorites</a>    &nbsp;
        <a id="white" href="./Browse-Search-Results.php">Browse/Search Results</a>&nbsp;
    <a id="white" href="./Search.php">Search</a>    &nbsp;
    <a  id="white" href="./aboutus.php">About Us</a>
    </nav></div>
</header>

        <div class="wrapper">
    <div class="item" ><a  id="altText" href="./SingleSong.php?action=topgenres" >Top Genres</a></div>

    <div class="item"><a id="altText" href="./SingleSong.php?action=topartist">Top Artist</a></div>
  
    <div class="item"><a  id="altText" href="./SingleSong.php?action=popularsongs">Most Popular Songs</a></div>

    <div class="item"><a id="altText"  href="./SingleSong.php?action=onehitwonders">One Hit Wonders Songs</a></div>

<div class="item"><a id="altText" href="./SingleSong.php?action=longestacoustic">Longest Acoustic Songs</a></div>

<div class="item"><a id="altText" href="./SingleSong.php?action=club">At The Club</a></div>

<div class="item"><a id="altText" href="./SingleSong.php?action=runningsongs">Running Songs</a></div>

    <div class="item"><a id="altText" href="./SingleSong.php?action=studying">Studying</a></div>

</div>

    <?php printFooter();?>
    </body>
</html>