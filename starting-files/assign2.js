


/* url of song api --- https versions hopefully a little later this semester */	
const api = 'http://www.randyconnolly.com/funwebdev/3rd/api/music/songs-nested.php';
// window.localStorage




const data = fetch(api).then(res => res.json());
console.log(data);


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
for (let i = 0; i<songs.length; i++){
   console.log(songs[i]);
}
const artist = JSON.parse(artistData);
console.log(artist);
const generes = JSON.parse(generesData);
console.log(generes);
const sampleSong = JSON.parse(artistData);
console.log(sampleSong);
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












