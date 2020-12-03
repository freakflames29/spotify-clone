<?php

$songQuery = mysqli_query($con, "SELECT id FROM songs ORDER BY RAND() LIMIT 10");
// if($rr=mysqli_num_rows($))

$resultSongArray = array();
while ($row = mysqli_fetch_array($songQuery)) {
    array_push($resultSongArray, $row['id']);

}

$jsonSongArray = json_encode($resultSongArray);

?>
<script>
	$(document).ready(function ()
	{
		currentPlaylist=<?php echo $jsonSongArray; ?>;
		audioElement=new Audio();

			setTrack(currentPlaylist[0],currentPlaylist,false);

			updateVolume(audioElement.audio);

			// preventing buttons being selected by preventDefault

			$("#nowPlayingbarContainer").on("mousedown touchstart mousemove touchmove",function(e)
			{
					e.preventDefault();
			});


			//!TODO mouse drag  for progress music bar


			$(".playbackBar .progressBar").mousedown(function()
			{
					mouseDown=true;
			});

			$(".playbackBar .progressBar").mousemove(function(e)
			{
				if (mouseDown) {
					// set the song depending the position of mouse
					timeFromOffset(e,this);

				}
			});

			$(".playbackBar .progressBar").mouseup(function(e)
			{
				timeFromOffset(e,this);
				
			});

				//for vloume bar
			$(".volumeBar .progressBar").mousedown(function()
			{
					mouseDown=true;
			});

			$(".volumeBar .progressBar").mousemove(function(e)
			{
				if(mouseDown)
				{

				let VolumePercentage=e.offsetX/$(this).width();
				if(VolumePercentage>=0&&VolumePercentage<=1)
				{
				audioElement.audio.volume=VolumePercentage;

				}

				}
			});

			$(".volumeBar .progressBar").mouseup(function(e)
			{
				// let VolumePercentage=e.offsetX/$(this).width();
				// audioElement.audio.volume=VolumePercentage;
				let VolumePercentage=e.offsetX/$(this).width();
				if(VolumePercentage>=0&&VolumePercentage<=1)
				{
				audioElement.audio.volume=VolumePercentage;

				}


			});


			$(document).mouseup(function(e)
			{
				mouseDown=false;
				
			});




	});

	// song progress changing on user behaviour
	function timeFromOffset(mouse,progress)
	{
		// let percentage=mouse.offsetX / $(progress).width() *100;
		let percentage=mouse.offsetX / $(progress).width() ;
		// let seConds=audioElement.audio.duration * (percentage/100);
		let seConds=audioElement.audio.duration * (percentage);

		audioElement.setTime(seConds);



	}
	// changing the next song
	function nextSong()
	{
		if(currentIndex==currentPlaylist.length - 1)
		{
			currentIndex=0;
		}
		else
		{
			currentIndex++;
		}
		let TrackkToplay=currentPlaylist[currentIndex];
		setTrack(TrackkToplay,currentPlaylist,true);
	}

	function setTrack(trackId,newPlaylist,play)
	{
	    $.post("includes/handlers/ajax/getSongJson.php",{songId:trackId},function (data)
        {
			// setting current index
			currentIndex=currentPlaylist.indexOf(trackId);

        	let songParse=JSON.parse(data);
        	// printing the tracknae dynamically
        	$(".trackname span").text(songParse.title);

        	/* for getting artist name we have to make an another ajax call with the data which we get from the getSongJson.php artist column and pass it in a artist id parameter */

	    $.post("includes/handlers/ajax/getArtistJson.php",{artistId:songParse.artist},function (data)
	    {
	    		var artistParse=JSON.parse(data);
	    		// console.log(artistParse.name);
	    		$(".artistname span").text(artistParse.name);

	    });

	    	/*For getting the artwork we will we extract album id fire a query in album table and get the artwork path and update the src attribute*/

	   $.post("includes/handlers/ajax/getArtworkJson.php",{artworkId:songParse.album},function (data)
	    {
	    		var artworkParse=JSON.parse(data);
	    		// console.log(artworkParse.artworkPath);
	    		// $(".albumlink img").attr("src",artworkParse.artworkPath);
	    		$(".albumArtWork").attr("src",artworkParse.artworkPath);

	    });


            audioElement.setTrack(songParse);
	     // $.post("includes/handlers/ajax/updatePlays.php",{songiD:audioElement.currentPlaying.id},function(data)
	     // 	{
	     // 		console.log(data);
	     // 	});

        // if(audioElement.audio.currentTime==0)
        // {
        //     console.log("nonno");
        //     $.post("includes/handlers/ajax/updatePlays.php",{songiD:audioElement.currentPlaying.id});

        // }
        // else {
        	
        // 	console.log("dofnp");
        // }

        // playSong();
            // audioElement.play();
      });
		// audioElement.justrun()
        // audioElement.justrun();
        // if(play)
        // {
		//  audioElement.audio.play();
        //
        // }
        // console.log(audioElement);

	}
	function  playSong()
    {
        if(audioElement.audio.currentTime==0)
        {
            // console.log(audioElement);
            $.post("includes/handlers/ajax/updatePlays.php",{songiD:audioElement.currentPlaying.id});

        }


        $(".controlButton.play").hide();
        $(".controlButton.pause").show();
        audioElement.play();
    }
    function pauseSong()
    {
        $(".controlButton.play").show();
        $(".controlButton.pause").hide();
        audioElement.pause();
    }

</script>

<div id="nowPlayingbarContainer">

	<div id="nowPlayingbar">

		<div id="nowPlayingleft">

			<div class="content">

				<span class="albumlink">
					<img src="https://www.google.com/url?sa=i&url=https%3A%2F%2Fpngio.com%2FPNG%2Fa34404-red-square-png.html&psig=AOvVaw3NytbWJjH2PrrlH3BCnXSU&ust=1607011998076000&source=images&cd=vfe&ved=0CAIQjRxqFwoTCKDe2q7Yr-0CFQAAAAAdAAAAABAD" class="albumArtWork">
				</span>
				<div class="trackinfo">
					<span class="trackname">
						<span></span>
					</span>
					<span class="artistname">
						<span></span>
					</span>

				</div>

			</div>

		</div>
	<div id="nowPlayingcenter">
		<div class="content playerControl">
			<div class="buttons">
				<button class="controlButton shuffle" title="shuffle button">
					<img src="includes/assets/images/icons/shuffle.png" alt="shuffle">

				</button>
				<button class="controlButton previous" title="previous button">
					<img src="includes/assets/images/icons/previous.png" alt="previous">

				</button>
				<button class="controlButton play" title="play button" onclick="playSong()">
					<img src="includes/assets/images/icons/play.png" alt="play">

				</button>
				<button class="controlButton pause" title="pause button" style="display: none;" onclick="pauseSong()">
					<img src="includes/assets/images/icons/pause.png" alt="pause">

				</button>
				<button class="controlButton next" title="next button" onclick="nextSong()">
					<img src="includes/assets/images/icons/next.png" alt="next">

				</button>
				<button class="controlButton repeat" title="repeat button">
					<img src="includes/assets/images/icons/repeat.png" alt="repeat">

				</button>
			</div>
			<div class="playbackBar">
				<span class="progressTime current">0.00</span>

				<div class="progressBar">
					<div class="progressBarBg">
						<div class="progress"></div>
					</div>
				</div>

				<span class="progressTime remaining">0.00</span>
			</div>
		</div>
	</div>

		<div id="nowPlayingright">
			<div class=" volumeBar">
				<button class=" controlButton volume" title="volume button">
					<img src="includes/assets/images/icons/volume.png" id="volume" alt="volume button">
				</button>
				<div class="progressBar">
					<div class="progressBarBg">
						<div class="progress"></div>
					</div>
				</div>
			</div>

		</div>

	</div>
</div>
