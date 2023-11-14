


/* url of song api --- https versions hopefully a little later this semester */	
const api = 'http://www.randyconnolly.com/funwebdev/3rd/api/music/songs-nested.php';
// window.localStorage

const filteredArray=[];


// const data = fetch(api).then(res => res.json());
// console.log(data);
// for (let i = 0; i<data.length; i++){
// // console.log(data[i].id);
// }


// let data_serialized = JSON.stringify(data);


 

/* note: you may get a CORS error if you try fetching this locally (i.e., directly from a
   local file). To work correctly, this needs to be tested on a local web server.  
   Some possibilities: if using Visual Code, use Live Server extension; if Brackets,
   use built-in Live Preview.
*/



const songs = JSON.parse(songsArray);
const artist = JSON.parse(artistData);
const generes = JSON.parse(generesData);

// console.log(tempArray);
function searchTitle(title) {
const rtnStmt = songs.filter(item => item.genre.id === title );
return rtnStmt;
}
console.log(searchTitle(110));

function addArtist() {
   let empty = document.createElement("option");
   empty.value = "";
   empty.textContent = "Select a Artist";
   document.querySelector("#artistSearch").appendChild(empty);
 
         for(let i = 0; i<artist.length; i++){
            let option = document.createElement("option");
            option.textContent = artist[i].name;
            option.value = artist[i].id;
            document.querySelector("#artistSearch").appendChild(option);
         }
}
addArtist();
function addGenre(){
   
   let empty = document.createElement("option");
   empty.value = "";
   empty.textContent = "Select a Genere";
   document.querySelector("#genreSearch").appendChild(empty);
         for(let i = 0; i<generes.length; i++){
            let option = document.createElement("option");
            option.textContent = generes[i].name;
            option.value = generes[i].id;
            document.querySelector("#genreSearch").appendChild(option);
         }
  
}
addGenre();


function getNodes(){
   const radioButtons = document.querySelectorAll('input[name="searchFilter"]');

   const genereSearchFilter = document.querySelector("#genreSearch");
   const titleSearchFilter = document.querySelector("#titleSearch");
   const artistSearchFilter = document.querySelector("#artistSearch");
   //const radioButtons = document.querySelectorAll('input[name="searchFilter"]');
   
   for(let i = 0; i<radioButtons.length; i++){
      if (radioButtons[i].disabled == false){
         if(radioButtons[i].value=="artist"){
           let choosenValue = artistSearchFilter.options[artistSearchFilter.selectedIndex].value
            // = document.querySelector("#artistSearch").value;
            const tempA =  songs.filter(item => item.artist.id == choosenValue);
            tempA.forEach((item)=>{filteredArray.push(item)});
            // console.log(rtnStmt);
            
         } else if (radioButtons[i].value=="genre"){
            let choosenValue = genereSearchFilter.options[genereSearchFilter.selectedIndex].value
            const tempA =  songs.filter(item => item.genre.id == choosenValue);
            tempA.forEach((item)=>{filteredArray.push(item)});
            // console.log(rtnStmt);
            
         } else {
            let choosenValue = titleSearchFilter.value;

            const tempA = songs.filter(item => item.title == choosenValue );
            tempA.forEach((item)=>{filteredArray.push(item)});

            


            
            }
         }
      }
    
   
} 


console.log(filteredArray);
//console.log(JSON.parse(objs));




document.addEventListener("DOMContentLoaded", function(){
   const radioButtons = document.querySelectorAll('input[name="searchFilter"]');
   const clearButton = document.querySelector("#clear-btn");
   const titleFilter = document.querySelector("#titleFilter");
   const artistFilter = document.querySelector("#artistFilter");
   const genereFilter = document.querySelector("#genreFilter");
   const genereSearchFilter = document.querySelector("#genreSearch");
   const titleSearchFilter = document.querySelector("#titleSearch");
   const artistSearchFilter = document.querySelector("#artistSearch");
   

console.log(radioButtons);


   titleFilter.addEventListener("click", function(){

      titleSearchFilter.removeAttribute('disabled');
      artistFilter.setAttribute("disabled","");
      artistSearchFilter.setAttribute("disabled","");
      genereFilter.setAttribute("disabled","");
      genereSearchFilter.setAttribute("disabled","");
      titleSearchFilter.addEventListener("change", function(){
         getNodes();
         console.log();
      })
      
   })

   artistFilter.addEventListener("click", function(){
      artistSearchFilter.removeAttribute("disabled");
      titleFilter.setAttribute("disabled","");
      titleSearchFilter.setAttribute("disabled","");
      genereFilter.setAttribute("disabled","");
      genereSearchFilter.setAttribute("disabled","");
      artistSearchFilter.addEventListener("change", function(){
         // console.log(artistSearchFilter.options[artistSearchFilter.selectedIndex].value);
         getNodes();
         
      });
      
   })

   genereFilter.addEventListener("click", function(){
      genereSearchFilter.removeAttribute("disabled");
      titleFilter.setAttribute("disabled","");
      titleSearchFilter.setAttribute("disabled","");
      artistFilter.setAttribute("disabled","");
      artistSearchFilter.setAttribute("disabled","");
      genereSearchFilter.addEventListener("change", function(){
         getNodes();
      })
   })

   clearButton.addEventListener("click", function(){
      
      artistFilter.removeAttribute("disabled");
      titleFilter.removeAttribute("disabled");
      genereFilter.removeAttribute("disabled");
      genereSearchFilter.removeAttribute("disabled");
      titleSearchFilter.removeAttribute("disabled");
      artistSearchFilter.removeAttribute("disabled");
      genereSearchFilter.selectedIndex=0;
      artistSearchFilter.selectedIndex=0;
      titleSearchFilter.value="";
      // document.querySelector("#genreSearch option").setAttribute();

   });






})







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
    const songTitleInput = document.getElementById('yourInputId');//HE DOES NOT WANT US TO USE GETS BUT RATHER QUERY
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
// const addButton = document.getElementById('yourButtonId');
// addButton.addEventListener('click', handleAddButtonClick);

// Snackbar

function showSnackbar() {
   // var snackbar = document.getElementById("snackbar");
   // snackbar
}





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












