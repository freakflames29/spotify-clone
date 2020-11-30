<!-- albums page -->
<?php include 'includes/header.php'; ?>

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
						<img class='play' src='includes/assets/images/icons/play-white.png'>
						<span class='trackNumber'>$i</span>

					</div>

			
			</li>";
			$i++;
		}

		?>

	</ul>

</div>

<?php include 'includes/footer.php'; ?>