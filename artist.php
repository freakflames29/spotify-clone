<?php 

include 'includes/includedFiles.php';

if (isset($_GET['id']))
{
	$artistId=$_GET['id'];
	
}
else
{
	header("Location:index.php");
}

$artistOb=new Artist($con,$artistId);

 ?>

 <div class="entityInfo borderBottom">

 	<div class="centerSection">

 		<div class="artistInfo">
 			<h1 class="artistName"><?php echo $artistOb->getName(); ?></h1>
				<div class="headerButtons">
					<button class="button green" onclick="ArtistPlaysong();">PLAY</button>
				</div> 			
 		</div>
 	</div>

 </div>


 <!-- songs are same as we code in album.php so we are pasting the code from there to here -->
 <div class="trackListContainer borderBottom">
 	<h2>Songs by <?php echo $artistOb->getName(); ?></h2>
	<ul class="tracklist">

	<?php
		$songsIdArray = $artistOb->getSongids();
		$i = 1;
		foreach ($songsIdArray as $songId) {

			if($i>5)
			{
				break;//if songs are greater than 5 we are breaking bad ><

			}
			$albumSong = new Song($con, $songId);
			$albumArtist = $albumSong->getsongArtist();
			// $titleofsong = $albumSong->getsongTitle();

			echo "<li class='tracklistRow'>
					<div class='trackCount'>
						<img class='play playTheSong' src='includes/assets/images/icons/play-white.png' onclick='setTrack(\"".$albumSong->getsongID()."\",tempPlaylist,true)'>
						<span class='trackNumber'>$i</span>

					</div>

					<div class='trackInfo'>
					<span class='trackName'>".$albumSong->getsongTitle()."</span>
					<span class='SongartistName'>".$albumArtist->getName()."</span>

					</div>

					<div class='trackOptions'>
							<input type='hidden' class='songId' value='".$albumSong->getsongID()."'>
						<img class='optionButton' src='includes/assets/images/icons/more.png' alt='more button' onclick='showOptions(this)'>
 					</div>

 					<div class='trackDuration'>

 						<span class='duration'>".$albumSong->getsongDuration()."</span>

 					</div>

			
			</li>";
			$i++;
		}

	?>
	<script >

		let tempSongids='<?php echo json_encode($songsIdArray);?>';
		tempPlaylist=JSON.parse(tempSongids);
		// console.log(tempPlaylist);

	</script>

	</ul>

</div>


<!-- viewing the albums -->

<div class="gridviewContainer">

	<h2>Albums by <?php echo $artistOb->getName(); ?> </h2>

<?php

$albumQuery = mysqli_query($con, "SELECT * FROM albums WHERE artist='$artistId' ");

while ($row = mysqli_fetch_array($albumQuery)) {

    echo "

					<div class='gridViewItem'>

                             <span  role='link' tabindex='0' onclick='onPage(\"albums.php?id=" . $row['id'] . "\")'>
 
							<img src=" . $row['artworkPath'] . ">
							<div class='gridViewinfo'>" . $row['title'] . "</div>
						</span>

					</div>";

}

?>

</div>


<nav class="optionsMenu">
	<input type="hidden" class="songId">
	<!-- <div class="item">Add to playlist</div> -->
	<!-- <select class="item playlist">
		<option value="">Add to playlist</option>
		</select> -->
		<?php echo Playlist::getPlaylistDropdown($con,$userLoggedin->getuserName()); ?>


</nav>