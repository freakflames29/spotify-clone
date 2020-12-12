<?php 

include 'includes/includedFiles.php';

if (isset($_GET['term']))
{
	$term=urldecode($_GET['term']);
	
}
else {
	$term="";
}

?>

<div class="searchConatiner">
	<h4>Search albums,songs or artist</h4>
	<input type="text" value="<?php echo $term ?>" class="searchInput" placeholder="Start typing..." onfocus="this.value = this.value;">
</div>
<script>
	
	$(".searchInput").focus();

	$(function()
	{
		$(".searchInput").keyup(function()
		{
			clearTimeout(timer);
			timer=setTimeout(function()
			{
				// console.log("hello");
				var val=$(".searchInput").val();
				onPage("search.php?term="+val);

			},1000)
		});
	})


</script>
<?php 

if($term=="")
{
	exit();
}

 ?>



<div class="trackListContainer borderBottom">
 	<!-- <h2>Songs by <?php //echo $artistOb->getName(); ?></h2> -->
 	<h2>Songs</h2>
	<ul class="tracklist">

	<?php

		//searching for the song on db
		$songsFetchQ=mysqli_query($con,"SELECT id FROM songs WHERE title LIKE '$term%'");
		// if(!$songsFetchQ)
		// {
		// 	echo 'sql erro';
		// }
		// else
		// {
		// 	echo 'no sql err';
		// }
		if(mysqli_num_rows($songsFetchQ)==0)
		{
			echo '<span class="noResults">No matching songs found for '."'".$term."'".'</span>';
		}

		$songsIdArray =array();
		$i = 1;
		while ($rows=mysqli_fetch_array($songsFetchQ))
		 {

			if($i>5)
			{
				break;//if songs are greater than 5 we are breaking bad ><

			}
			array_push($songsIdArray,$rows['id']);
			$albumSong = new Song($con, $rows['id']);
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
						<img class='optionButton' src='includes/assets/images/icons/more.png' alt='more button'>
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


<!-- making the artist found  -->

<div class="artistContainer borderBottom">
	
<h2>Artists</h2>

<?php 

	$artistFetchQ=mysqli_query($con,"SELECT id FROM artist WHERE name LIKE '$term%'");
	if(mysqli_num_rows($artistFetchQ)==0)
		{
			echo '<span class="noResults">No matching artist found for '."'".$term."'".'</span>';
		}

	while ($row=mysqli_fetch_array($artistFetchQ))
 	{
 		$artistFoundOb=new Artist($con,$row['id']);

 		echo "

 			<div class='searchResultRow'>

 				<div class='artistName'>

 					<span role='link' tabindex='0' onclick='onPage(\"artist.php?id=".$artistFoundOb->getArtistId()."\")'>".$artistFoundOb->getName()."</span>

 				</div>



 			</div>





 		";
	    
	}


 ?>

</div>


<!-- showing the albums -->
<div class="gridviewContainer">

	<h2>Albums</h2>
	<!-- <h2>Albums by <?php //echo $artistOb->getName(); ?> </h2> -->

 <?php

	$albumFetchQ=mysqli_query($con,"SELECT * FROM albums WHERE title LIKE '$term%'");

		if(mysqli_num_rows($albumFetchQ)==0)
		{
			echo '<span class="noResults">No matching albums found for '."'".$term."'".'</span>';
		}
		
	while ($row = mysqli_fetch_array($albumFetchQ))
	{

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