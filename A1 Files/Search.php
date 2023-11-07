<!-- <?php
require_once "../includes/config.inc.php";
require_once "../includes/helperfiles.php";
?>
<html>
    <head>

      <title>Search Page</title>
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
    

    <div class="section"> 
    
    <form action="./Browse-Search-Results.php" method="get">



    <fieldset>  
        <legend>Basic Song Search</legend>  
        <input type="radio" id = "title" name="search_type" value="title">Title</input>
        <input type="text" name="title" id="title"></input>


        <input type="radio" id = "artist" name="search_type" value="artist"> Artist </input>
        
        <select name="artist" id="artist"> 
            <option value="">Select an Option</option>
            <?php
            $listOfArtists = getArtist();
            foreach ($listOfArtists as $row) {
                echo "<option value='" .
                    $row["artist_name"] .
                    "'>" .
                    $row["artist_name"] .
                    "</option>";
            }
            ?>  </select>
        <input type="radio" id = "genre" name="search_type" value="genre">Genre</input>
       <select name="genre" >
        <option value="">Select an Option</option>
       <?php
        
        $listOfGenres = getGenre();
        foreach ($listOfGenres as $row){
            echo "<option value='" .
                        $row["genre_name"] .
                        "'>" .
                        $row["genre_name"] .
                        "</option>";
        }
        ?> </select>

       
        <input type="radio" name="search_type" value="Year">Year</input>
        
        <input type="radio" id  = "year_less" name="year_type" value="year_less">Less</input>
        <input type="text" name="year_less" id="year_less"> </input>
        <input type="radio" id = "year_greater" name="year_type" value="year_greater">Greater</input>
        <input type="text" name="year_greater" id="year_greater"></input>

 

<br>
<input type="submit" value="Search">


<input type="reset" value="Clear">

        

    </fieldset>
    </form>
    </div>
    <?php 
    
    printFooter();
    
    ?>

    </body>
</html> -->

<?php
require_once "config.inc.php";
require_once "helperfiles.php";
?>
<html>
    <head>

      <title>Search Page</title>
      <link rel="stylesheet" href="../styling_files/style.css">
    </head>
    <body>
     <div class="header"><nav class="navigation">
        <a id="white" href="Home.php">Home</a>&nbsp;
        <a id="white" href="SingleSong.php">Single Song</a>&nbsp;
        <a id="white" href="Favorites.php">Favorites</a>    &nbsp;
        <a id="white" href="Browse-Search-Results.php">Browse/Search Results</a>&nbsp;
    <a id="white" href="Search.php">Search</a>    &nbsp;
    <a  id="white" href="AboutUs.php">About Us</a>
    </nav></div>
    
<?php print_r(getArtist());?>

    <div class="section"> 
    
    <form action="Browse-Search-Results.php" method="get">



    <fieldset>  
        <legend>Basic Song Search</legend>  
        <input type="radio" id = "title" name="search_type" value="title">Title</input>
        <input type="text" name="title" id="title"></input>


        <input type="radio" id = "artist" name="search_type" value="artist"> Artist </input>
        
        <select name="artist" id="artist"> 
            <option value="">Select an Option</option>
            <?php
            $listOfArtists = getArtist();
            foreach ($listOfArtists as $row) {
                echo "<option value='" .
                    $row["artist_name"] .
                    "'>" .
                    $row["artist_name"] .
                    "</option>";
            }
            ?>  </select>
        <input type="radio" id = "genre" name="search_type" value="genre">Genre</input>
       <select name="genre" >
        <option value="">Select an Option</option>
       <?php
        
        $listOfGenres = getGenre();
        foreach ($listOfGenres as $row){
            echo "<option value='" .
                        $row["genre_name"] .
                        "'>" .
                        $row["genre_name"] .
                        "</option>";
        }
        ?> </select>

       
        <input type="radio" name="search_type" value="Year">Year</input>
        
        <input type="radio" id  = "year_less" name="year_type" value="year_less">Less</input>
        <input type="text" name="year_less" id="year_less"> </input>
        <input type="radio" id = "year_greater" name="year_type" value="year_greater">Greater</input>
        <input type="text" name="year_greater" id="year_greater"></input>

 

<br>
<input type="submit" value="Search">


<input type="reset" value="Clear">

        

        <fieldset>
    </form>
    </div>
    <?php 
    
    printFooter();
    
    ?>

    </body>
</html>