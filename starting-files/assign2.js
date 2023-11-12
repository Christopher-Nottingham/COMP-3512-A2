


/* url of song api --- https versions hopefully a little later this semester */	
const api = 'http://www.randyconnolly.com/funwebdev/3rd/api/music/songs-nested.php';
// window.localStorage




const data = fetch(api).then(res => res.json());
console.log(data);
for (let i = 0; i<data.length; i++){
// console.log(data[i].id);
}

//FINSIH local storage
let data_serialized = JSON.stringify(data);

// console.log(foo);
// fetch(api);
 

/* note: you may get a CORS error if you try fetching this locally (i.e., directly from a
   local file). To work correctly, this needs to be tested on a local web server.  
   Some possibilities: if using Visual Code, use Live Server extension; if Brackets,
   use built-in Live Preview.
*/



const songs = JSON.parse(songsArray);
const artist = JSON.parse(artistData);
const generes = JSON.parse(generesData);

const tempArray = [];
function empty(){
   if (tempArray.length > 0){
   tempArray.splice(tempArray.length);
}
}
function getSearchedData(id){
   empty();
   let id_searched = id.substring(id.length-1, id.length);
   console.log(id_searched);
   let idNonAppended = id.substring(0, id.length-1);
   console.log(idNonAppended);
   if (id_searched == "g"){ 
      for (let i = 0; i<songs.length; i++){
         if (songs[i].genre.id == idNonAppended){ 
         tempArray.push(songs[i]);
      }
   }
   } else if (id_searched == "t"){
      for (let i = 0; i<songs.length; i++){
      if (songs[i].song_id == idNonAppended){
         tempArray.push(songs[i]);
      }
   }
} 
   else if (id_searched == "a"){
      for (let i = 0; i<songs.length; i++){
      if (songs[i].artist.id == idNonAppended){ 
         tempArray.push([songs[i].artist]);
      }
   }
 } else {
      console.error("There are no songs with that id");
   }
}
// console.log(tempArray);
function searchByTitle() {
   let string = "";
   for (let i = 0; i < songs.length; i++) {
         string = string + "<option value=" + songs[i].song_id + "t>" + songs[i].title + "</option>";
   }
   return string;
}
function searchByArtist() {
   let string = "";
   for (let i = 0; i < songs.length; i++) {   
         string = string + "<option value=" + songs[i].artist.id + "a>" + songs[i].name + "</option>";
   }
   return string;
}
function searchGenre(){
   let string = "";
   for (let i = 0; i < songs.length; i++) {   
         string = string + "<option value=" + songs[i].genre.id + "g>" + songs[i].genre.name + "</option>";
   }
   return string;
}




getSearchedData("11a");



// Array to store the matched song IDs
const favoritesArray = [];

// Function to get the song ID by its title
function getSongIdByTitle(title) {
    const foundSong = songs.find(song => song.title === title);
    return foundSong ? foundSong.song_id : null;
}

// Function to handle button click and add song ID to the favorites array
function handleAddButtonClick() {
    // Read the song title from an input field (replace 'yourInputId' with the actual input field ID)
    const songTitleInput = document.getElementById('yourInputId');
    const songTitle = songTitleInput.value.trim();

    if (songTitle) {
        // Get the song ID using the title
        const songId = getSongIdByTitle(songTitle);

        if (songId) {
            // Add the song ID to the favorites array
            favoritesArray.push(songId);

            // Log the updated favorites array
            console.log('Favorites Array:', favoritesArray);

            // Optionally, you can update the UI or perform other actions here
        } else {
            // Handle the case where the song title is not found
            console.log(`No song found with title: ${songTitle}`);
        }
    } else {
        // Handle the case where the input field is empty
        console.log('Please enter a song title.');
    }
}

// Attach the function to the "Add" button click event (replace 'yourButtonId' with the actual button ID)
const addButton = document.getElementById('yourButtonId');
addButton.addEventListener('click', handleAddButtonClick);

// Snackbar

function showSnackbar() {
   var snackbar = document.getElementById("snackbar");
   snackbar





// const searchButton = document.querySelectorAll("asisde");
// console.log(searchButton);


// searchButton.addEventListener("click", function(event){



// });
// const apiData = JSON.parse(api);
// console.log(apiData);

//Add Nav bar 
// htmlstring = "";
// document.write(htmlstring);
//



// Implement part of the Search/Browse Songs view. 
 
// have the artist and genre select lists displaying the data in the provided json files

 
// display the song list (title, artist name, year, genre name, popularity) using the provided  sample-songs.json data.
//Implement the column sort 












