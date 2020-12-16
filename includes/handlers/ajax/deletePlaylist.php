<?php 

include '../../config.php';
if(isset($_POST['playlistId']))
{
	$playlistIdis=$_POST['playlistId'];
	$deletePlaylistId=mysqli_query($con,"DELETE FROM playlists WHERE id='$playlistIdis'");
	$deletePlaylistSongs=mysqli_query($con,"DELETE FROM playlistSongs WHERE playlistid='$playlistIdis'");

}
else
{
	echo 'playlistId not pased in deletePlaylist.php file';
}


 ?>