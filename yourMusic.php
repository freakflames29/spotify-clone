<?php
include 'includes/includedFiles.php';
?>

<div class="playlistsContainer">

	<div class="gridviewContainer">
		<h2>PLAYLISTS</h2>
		<div class="buttonItems">
			<button class="button green" onclick="createPlaylist()">
				New Playlist
			</button>	
		</div>

		<?php

				$usernameIs=$userLoggedin->getuserName();

			$playlistFetchQ=mysqli_query($con,"SELECT * FROM playlists WHERE owner='$usernameIs'");

				if(mysqli_num_rows($playlistFetchQ)==0)
				{
					echo '<span class="noResults">You don\'t have any playlists </span>';
				}
				
			while ($row = mysqli_fetch_array($playlistFetchQ))
			{			

					$playlistOb=new Playlist($con,$row);


		   				 echo "

					<div class='gridViewItem' role='link' tabindex='0'
					 onclick='onPage(\"playlist.php?id=".$playlistOb->getPlaylistid()."\")'>

							<div class='playlistImage'>

								<img src='includes/assets/images/icons/playlist.png' alt='playlist image'>

							</div>

							<div class='gridViewinfo'>" . $playlistOb->getPlaylistName(). "</div>
                            

					</div>";

			}

	?>
</div>

</div>