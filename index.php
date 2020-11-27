<?php
include 'includes/config.php';

if (isset($_SESSION['UserLoggedin'])) {
	$userNAME = $_SESSION['UserLoggedin'];
}
// else {
//     header("Location:register.php");
// }

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Welcome to Spotify</title>
	<link rel="stylesheet" href="includes/assets/style/style.css">
</head>

<body>
	<h1>hello</h1>
	<div id="nowPlayingbarContainer">
		<div id="nowPlayingbar">
			<div id="nowPlayingleft">
				<div class="content">
					<span class="albumlink">
						<img src="https://img.pngio.com/red-square-icon-free-red-shape-icons-red-square-png-256_256.png" alt="albumimg" class="albumArtWork">
					</span>
					<div class="trackinfo">
						<span class="trackname">
							<span>Another day of sun</span>
						</span>
						<span class="artistname">
							<span>Justin hurtwitz</span>
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
						<button class="controlButton play" title="play button">
							<img src="includes/assets/images/icons/play.png" alt="play">

						</button>
						<button class="controlButton pause" title="pause button" style="display: none;">
							<img src="includes/assets/images/icons/pause.png" alt="pause">

						</button>
						<button class="controlButton next" title="next button">
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
</body>

</html>