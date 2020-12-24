<?php 

include '../../config.php';
if(isset($_POST['playlistID'])&& isset($_POST['songID']))
{

	$playlistID=$_POST['playlistID'];
	$songID=$_POST['songID'];

	$delete_song_Query=mysqli_query($con,"DELETE FROM playlistSongs WHERE playlistid='$playlistID' AND songid='$songID'");

	// a simple query to delete the song from the database

}
else
{
	echo 'songID or playlistID not passed correctly in removeSongPlaylist.php';
}


 ?>