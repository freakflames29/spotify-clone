<?php 
include '../../config.php';

if(isset($_POST['playlistID'])&& isset($_POST['songID']))
{

	$playlistID=$_POST['playlistID'];
	$songID=$_POST['songID'];

	// we are getting the playlist order
	$playlist_max_order=mysqli_query($con,"SELECT MAX(playlistOrder)+1 as playlistOrder FROM playlistSongs WHERE playlistid='$playlistID'");


		// if($playlist_max_order==false)
		// {
		// 	echo 'sql errorsdsds';
		// }
	

	$fetch_Result=mysqli_fetch_array($playlist_max_order);
	$order=$fetch_Result['playlistOrder'];

	// echo $order;
	// echo $order;

	// $insert_song_to_db=mysqli_query($con,"INSERT INTO playlistSongs (songid,playlistid,playlistOrder) VALUES('$songID','$playlistID','$order')");

	$inQ=mysqli_query($con,"INSERT INTO playlistSongs (songid,playlistid,playlistOrder) VALUES('$songID','$playlistID','$order')");
	if ($inQ)
	{
		echo 'fine';
		
	}
	else
	{
		echo 'not fine';
	}


		



}
else {
	
	echo 'songID or playlistid not set correctly';
}


 ?>