<?php
require_once "../includes/config.inc.php";
require_once "../includes/helperfiles.php";
?>
<html>
    <head>
<title>Browse/Search Results Page</title>
<link rel="stylesheet" href="../styling_files/style.css">
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
<form action="Browse-Search-Results.php" method="get">

<input type="submit" value="Show All" name="clicked"  >
</form>

<table>
    <tr>
        <th>Title</th>
        <th>Artist Name</th>
        <th>Year</th>
        <th>Genere Name</th>
        <th>Popularity Score</th>
        <th>Add to Favorites</th>
        <th>View</th>
    </tr>
    <tbody>
        <?php
        getSongBrowseSearchResults();
        ?>
    </tbody>
</table>
</div>
<?php printFooter();?>
    </body>
</html>