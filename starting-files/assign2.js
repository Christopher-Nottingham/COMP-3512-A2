/* url of song api --- https versions hopefully a little later this semester */  
const api = 'http://www.randyconnolly.com/funwebdev/3rd/api/music/songs-nested.php';


document.addEventListener('DOMContentLoaded', function () {
   // Initialize your app here
   const storedSongs = getStoredData();
   if (storedSongs) {
       displaySongs(storedSongs);
   } else {
       // Fetch and store the songs if not in local storage
       fetchDataFromApi();
   }

  // This event listener is for the Playlist View (index2.html)
document.addEventListener('DOMContentLoaded', function () {

   if (document.getElementById('playlist-table')) {
       displayPlaylist();
       updatePlaylistSummary();
   }

});


document.addEventListener('DOMContentLoaded', function () {
   if (window.location.pathname.includes('index3.html') || window.location.href.includes('index3.html')) {
       // fetch and display song details
       const songId = getSongIdFromUrl(); // function to get the song ID from the URL
       if (songId) {
           const song = getSongDetails(songId); // function to get song details based on the ID
           if (song) {
               displaySongInfo(song); // function to display song information
           } else {
               console.error('Song not found');
           }
       } else {
           console.error('No songId provided in the URL');
       }
   }

   // Event listener for the Close View button in index3.html
   const closeButton = document.getElementById('closeButton');
   if (closeButton) {
       closeButton.addEventListener('click', function () {
           window.location.href = 'index.html';
       });
   }
          // for playlist view page (index2.html)
          if (window.location.pathname.includes('index2.html')) {
            displayPlaylist();
            updatePlaylistSummary();
        }
});



// function retrieves the song ID from the URL
function getSongIdFromUrl() {
   const urlParams = new URLSearchParams(window.location.search);
   return urlParams.get('songId');
}
// function to get song details based on the song id 
function getSongDetails(songId) {
   const songs = getStoredData(); // Function to get stored songs data
   return songs.find(song => song.id === songId);
}


  

   // event listeners for filtering
   document.getElementById('filter-btn').addEventListener('click', function() {
       applyFilter();
   });

   

   // event listener for clearing filters
   document.getElementById('clear-btn').addEventListener('click', function() {
       clearFilter();
       displaySongs(getStoredData());
   });



   document.addEventListener('click', function(event) {
      if (event.target.classList.contains('add-btn')) {
          const row = event.target.closest('tr');
          const song = {
              title: row.cells[0].textContent,
              artist: row.cells[1].textContent,
              year: row.cells[2].textContent,
              genre: row.cells[3].textContent,
              popularity: row.cells[4].textContent
          };
          // retrieve the existing playlist from local storage, or initialize a new array if none exists
          let playlist = JSON.parse(localStorage.getItem('playlist')) || [];
          playlist.push(song);
          // store the updated playlist back into local storage
          localStorage.setItem('playlist', JSON.stringify(playlist));
          showSnackbar(`${song.title} added to playlist`);
      }
  });
  

});


// function to check if the data is in local storage and return it
function getStoredData() {
   const storedData = localStorage.getItem('songData');
   if (storedData) {
       return JSON.parse(storedData);
   } else {
       return null;
  }
}

// function to fetch data from the API and store it in local storage
function fetchDataFromApi() {
   fetch(api)
       .then(response => response.json())
       .then(data => {
           localStorage.setItem('songData', JSON.stringify(data));
           console.log('Data fetched and stored in local storage.');
       })
       .catch(error => console.error('Error fetching data:', error));
}



// function to initialize data
function initializeData() {
   const data = getStoredData();
   if (!data) {
       console.log('Fetching data from API...');
       fetchDataFromApi();
   } else {
       console.log('Data retrieved from local storage.');
       populateDropdowns(data);
   }
}




document.addEventListener('DOMContentLoaded', function () {
   // Initialize
   initializeData();
   setupSortingListeners();
});

// Display Songs List

function displaySongs(songs) {
   // Checks songs-table element exists
   const songsTable = document.getElementById('songs-table');
   if (songsTable) {
      songsTable.innerHTML = ''; // Clear existing rows

      songs.forEach(song => {
         const row = songsTable.insertRow();
          // Parse the popularity as an integer. If it's not a valid number, default to 0.
          const popularity = parseInt(song.details.popularity) || 0;
         row.innerHTML = `
         <td><a href="index3.html?songId=${encodeURIComponent(song.id)}" class="song-title">${song.title}</a></td>
            <td>${song.artist.name}</td>
            <td>${song.year}</td>
            <td>${song.genre.name}</td>
            <td>${popularity}</td>
            <td><button class="add-btn btn btn-primary">Add</button></td>
         `;

         // Make title clickable
         const titleCell = row.cells[0];
         titleCell.classList.add('clickable');
         titleCell.addEventListener('click', () => {
         });
      });
   }
}

// Sorting Functionality

function sortSongsBy(field) {
   const songs = getStoredData();
   if (!songs) return;

   songs.sort((a, b) => {
       return a[field].localeCompare(b[field]);
   });

   displaySongs(songs);
   showSnackbar('Sorted by ' + field);
}

document.querySelectorAll('.sorting-button').forEach(button => {
   button.addEventListener('click', () => {
       const field = button.querySelector('.sort-title').textContent.toLowerCase();
       sortSongsBy(field);
   });
});

// Snackbar Functionality
function showSnackbar(message) {
   const snackbar = document.getElementById('snackbar');
   snackbar.textContent = message;
   snackbar.classList.add('show');
   setTimeout(() => {
       snackbar.classList.remove('show');
   }, 3000);
}

//  Add to Playlist

let playlist = [];

document.addEventListener('click', function(event) {
    if (event.target.classList.contains('add-btn')) {
        const row = event.target.closest('tr');
        const song = {
            title: row.cells[0].textContent,
            artist: row.cells[1].textContent,
            year: row.cells[2].textContent,
            genre: row.cells[3].textContent,
            popularity: row.cells[4].textContent
        };
        playlist.push(song);
        showSnackbar(`${song.title} added to playlist`);
    }
});

// Convert duration in seconds to minutes and seconds
function formatDuration(seconds) {
   const minutes = Math.floor(seconds / 60);
   const remainingSeconds = seconds % 60;
   return `${minutes}m ${remainingSeconds}s`;
}

function displaySongInfo(song) {
   // Select the element where song information will be displayed
   const songInfoElement = document.querySelector('.song-information');
   songInfoElement.innerHTML = `
       <h2>Song Information</h2>
       <p>Title: ${song.title}</p>
       <p>Artist Name: ${song.artist}</p>
       <p>Artist Type: ${song.type}</p>
       <p>Genre: ${song.genre}</p>
       <p>Year: ${song.year}</p>
       <p>Duration: ${song.duration}</p>
       <h3>Analysis data:</h3>
       <ul>
           <li>BPM: ${song.details.bpm}</li>
           <li>Energy: ${song.analytics.energy}</li>
           <li>Danceability: ${song.analytics.danceability}</li>
       </ul>
   `;
}

function removeFromPlaylist(index) {
   let playlist = JSON.parse(localStorage.getItem('playlist')) || [];
   playlist.splice(index, 1); // Remove the song from the playlist array at the specified index
   localStorage.setItem('playlist', JSON.stringify(playlist)); // Update local storage with the new playlist
   displayPlaylist(); // Re-display the playlist without the removed song
   updatePlaylistSummary(); // Update the playlist summary information
}

//  Display Playlist

function displayPlaylist() {
   const playlistTableBody = document.getElementById('playlist-table').querySelector('tbody');
   playlistTableBody.innerHTML = ''; // Clear existing entries
   // Retrieve the playlist from local storage
   let playlist = JSON.parse(localStorage.getItem('playlist')) || [];

   playlist.forEach((song, index) => {
       const row = playlistTableBody.insertRow(-1); 
       row.innerHTML = `
       <td><a href="index3.html?songId=${song.id}" class="song-title">${song.title}</a></td>
           <td>${song.artist}</td>
           <td>${song.year}</td>
           <td>${song.genre}</td>
           <td>${song.popularity}</td>
       `;

       // Add a remove button with an event listener
       const removeButtonCell = row.insertCell();
       const removeButton = document.createElement('button');
       removeButton.textContent = 'Remove';
       removeButton.className = 'btn btn-outline-primary remove-btn';
       // Assign a click event listener to the remove button
       removeButton.addEventListener('click', function() {
           removeFromPlaylist(index); // Pass the index to the removeFromPlaylist function
       });
       removeButtonCell.appendChild(removeButton);
       const titleCell = row.cells[0];
       titleCell.addEventListener('click', () => {
       });
   });

   updatePlaylistSummary(); // Update the summary information of the playlist
}

function removeFromPlaylist(index) {
   let playlist = JSON.parse(localStorage.getItem('playlist')) || [];
   playlist.splice(index, 1); // Remove the song from the playlist array at the specified index
   localStorage.setItem('playlist', JSON.stringify(playlist)); // Update local storage with the new playlist
   displayPlaylist(); // Re-display the playlist without the removed song
   updatePlaylistSummary(); // Update the playlist summary information
}

function updatePlaylistSummary() {
   const songCount = getPlaylistSongCount();
   const songCountElement = document.getElementById('songCount');
   const averagePopularity = calculateAveragePopularity();
   const popularityRankingElement = document.getElementById('popularityRanking');


   songCountElement.textContent = songCount;
   popularityRankingElement.textContent = Math.round(averagePopularity); // Whole number for average popularity
}

      // close View button functionality
      const closeButton = document.getElementById('closeButton');
      closeButton.addEventListener('click', function () {
          window.location.href = 'index.html';
      });

    document.addEventListener('DOMContentLoaded', function () {
        displayPlaylist();
        updatePlaylistSummary();
        
        // clear Playlist button functionality
        const clearPlaylistButton = document.getElementById('clearPlaylistButton');
        clearPlaylistButton.addEventListener('click', function () {
            playlist = []; // Clear the playlist array
            displayPlaylist(); // Update the display
            updatePlaylistSummary(); // Update the summary info
        });

    });
    // clearPlaylist() function
    function clearPlaylist() {
      localStorage.setItem('playlist', JSON.stringify([])); // Clear the playlist in local storage
      displayPlaylist(); // Update the display
      updatePlaylistSummary(); // Update the summary info
  }

  function calculateAveragePopularity() {
   // Retrieve the playlist from local storage
   const playlist = JSON.parse(localStorage.getItem('playlist')) || [];
   
   // Calculate the total popularity by summing up the popularity of each song
   const totalPopularity = playlist.reduce((sum, song) => {
       return sum + (Number(song.popularity) || 0);
   }, 0);
   
   // Calculate the average popularity
   // no songs = 0
   const averagePopularity = playlist.length > 0 ? totalPopularity / playlist.length : 0;
   
   // Return the average popularity
   return averagePopularity;
}
// function to update the average popularity display
function updateAveragePopularityDisplay() {
   const averagePopularity = calculateAveragePopularity();
   
   // Update the HTML content of the average popularity element
   const averagePopularityElement = document.getElementById('averagePopularity');
   averagePopularityElement.textContent = Math.round(averagePopularity); // rounded to the nearest whole number
}
    
// remove song from playlist
function removeFromPlaylist(index) {
   // Retrieve the playlist from local storage
   let playlist = JSON.parse(localStorage.getItem('playlist')) || [];
   
   // Remove the song from the playlist array at the specified index
   playlist.splice(index, 1);
   
   // Update local storage with the new playlist
   localStorage.setItem('playlist', JSON.stringify(playlist));
   
   // Re-display the playlist without the removed song
   displayPlaylist();
   
   // Update the playlist summary information
   updatePlaylistSummary();
}

function getPlaylistSongCount() {
   // Retrieve the playlist from local storage
   const playlist = JSON.parse(localStorage.getItem('playlist')) || [];
   
   // Return the number of songs in the playlist
   return playlist.length;
}

// Clear filter function
function clearFilter() {
   document.getElementById('titleSearch').value = '';
   document.getElementById('artistSearch').selectedIndex = 0;
   document.getElementById('genreSearch').selectedIndex = 0;
   displaySongs(getStoredData());
}

// Apply filter function
function applyFilter() {
   // Retrieve the value of the selected radio button
   const selectedFilter = document.querySelector('input[name="searchFilter"]:checked').value;
   const searchInput = document.getElementById(selectedFilter + 'Search').value.trim().toLowerCase();
   let songs = getStoredData();
   
   // Filter based on the selected radio button
   switch (selectedFilter) {
      case 'title':
         if (searchInput) {
            songs = songs.filter(song => song.title.toLowerCase().includes(searchInput));
         }
         break;
      case 'artist':
         if (searchInput) {
            songs = songs.filter(song => song.artist.name.toLowerCase().includes(searchInput));
         }
         break;
      case 'genre':
         if (searchInput) {
            songs = songs.filter(song => song.genre.name.toLowerCase().includes(searchInput));
         }
         break;
   }

   displaySongs(songs);
}


function populateDropdown(dropdownId, options, defaultText) {
   const select = document.getElementById(dropdownId);
   const defaultOption = document.createElement('option');
   defaultOption.value = '';
   defaultOption.textContent = defaultText;
   select.appendChild(defaultOption);

   options.forEach(option => {
       const optionElement = document.createElement('option');
       optionElement.value = option;
       optionElement.textContent = option;
       select.appendChild(optionElement);
   });
}

// Populate artist and genre dropdowns
function populateDropdowns(songs) {
   const artistSet = new Set();
   const genreSet = new Set();

   songs.forEach(song => {
       artistSet.add(song.artist.name);
       genreSet.add(song.genre.name);
   });

   populateDropdown('artistSearch', Array.from(artistSet), 'Select an Artist');
   populateDropdown('genreSearch', Array.from(genreSet), 'Select a Genre');
}