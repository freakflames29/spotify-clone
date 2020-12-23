<!-- albums page -->

<!-- <?php //include 'includes/header.php'; ?> -->
<?php include 'includes/includedFiles.php'; ?>

<!-- just because we changes the a link with span link there we included header and footer so we have to remove footer and header from here also other wise it will override the footer and header and we see an extra margin -->

<!-- retrieving albumID -->
<?php
if (isset($_GET['id'])) {
	$albumId = $_GET['id'];
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

$albumOb = new Album($con, $albumId);

// getting artist information from Album class

$artistName = $albumOb->getArtist(); //new Artist($this->con, $this->artist);

// echo $albumOb->getTitle() . "<br>";
// echo $artistName->getName();

?>
<div class="entityInfo">

	<div class="leftSection">
		<img src="<?php echo $albumOb->getArtworkPath(); ?>" alt="Artwork">
	</div>

	<div class="rightSection">
		<h2><?php echo $albumOb->getTitle(); ?></h2>
		<p>By <?php echo $artistName->getName(); ?></p>
		<P><?php echo $albumOb->getSongsCount(); ?> Songs</P>
	</div>

</div>

<div class="trackListContainer">
	<ul class="tracklist">

	<?php
		$songsIdArray = $albumOb->getSongids();
		$i = 1;
		foreach ($songsIdArray as $songId) {
			$albumSong = new Song($con, $songId);
			$albumArtist = $albumSong->getsongArtist();
			// $titleofsong = $albumSong->getsongTitle();

			echo "<li class='tracklistRow'>
					<div class='trackCount'>
						<img class='play'  src='includes/assets/images/icons/play-white.png' onclick='setTrack(\"".$albumSong->getsongID()."\",tempPlaylist,true)'>
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

<!-- <?php //include 'includes/footer.php'; ?> -->
<!-- read line 5 why i comment this -->


<!-- option buttion -->
<nav class="optionsMenu">
	<input type="hidden" class="songId">
	<!-- <div class="item">Add to playlist</div> -->
	<!-- <select class="item playlist">
		<option value="">Add to playlist</option>
		</select> -->
		<?php echo Playlist::getPlaylistDropdown($con,$userLoggedin->getuserName()); ?>


</nav>