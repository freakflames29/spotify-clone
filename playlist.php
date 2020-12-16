 <!-- Playlist page -->

<!-- <?php //include 'includes/header.php'; ?> -->
<?php include 'includes/includedFiles.php'; ?>

<!-- just because we changes the a link with span link there we included header and footer so we have to remove footer and header from here also other wise it will override the footer and header and we see an extra margin -->

<!-- retrieving albumID -->
<?php
if (isset($_GET['id'])) {
	$playlistID = $_GET['id'];
} else {
	header("Location:index.php");
}
// information about album q
// $albumQuery  = mysqli_query($con, "SELECT * FROM albums WHERE id='$albumId'");
// $albumResult = mysqli_fetch_array($albumQuery);

// getiing artist information

// $artistID=$albumResult['artist'];

// creating artist class object

// $artist=new Artist($con,$artistID);

// **************creating Album class object and calling the fuction from there*****************

$playlistOb=new Playlist($con,$playlistID);//creating playlist object
$ownerOb=new User($con,$playlistOb->getOwnerName());//creating owner object

?>
<div class="entityInfo">

	<div class="leftSection">
		<img src="includes/assets/images/icons/playlist.png" alt="Artwork">
	</div>

	<div class="rightSection">
		<h2><?php echo $playlistOb->getPlaylistName(); ?></h2>
		<p>By <?php echo $playlistOb->getOwnerName(); ?></p>
		<P><?php echo $playlistOb->getNumberOfsongs(); ?> Songs</P>
		<button class="button" onclick="deletePlaylist('<?php echo $playlistID; ?>')">DELETE PLAYLIST </button>
	</div>

</div>

<div class="trackListContainer">
	<ul class="tracklist">

	<?php
		$songsIdArray = $playlistOb->getSongids();
		$i = 1;
		foreach ($songsIdArray as $songId) {
			$PlaylistSong = new Song($con, $songId);
			$PlaylistArtist = $PlaylistSong->getsongArtist();
			// $titleofsong = $PlaylistSong->getsongTitle();

			echo "<li class='tracklistRow'>
					<div class='trackCount'>
						<img class='play'  src='includes/assets/images/icons/play-white.png' onclick='setTrack(\"".$PlaylistSong->getsongID()."\",tempPlaylist,true)'>
						<span class='trackNumber'>$i</span>

					</div>

					<div class='trackInfo'>
					<span class='trackName'>".$PlaylistSong->getsongTitle()."</span>
					<span class='SongartistName'>".$PlaylistArtist->getName()."</span>

					</div>

					<div class='trackOptions'>
						<img class='optionButton' src='includes/assets/images/icons/more.png' alt='more button'>
 					</div>

 					<div class='trackDuration'>

 						<span class='duration'>".$PlaylistSong->getsongDuration()."</span>

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

<!-- <?php //include 'includes/footer.php'; ?> -->
<!-- read line 5 why i comment this -->