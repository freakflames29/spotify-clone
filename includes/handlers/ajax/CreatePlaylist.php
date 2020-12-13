<?php 
// include 'includes/config.php';
include '../../config.php';
if(isset($_POST['name'])&& isset($_POST['username']))
{

	$name=$_POST['name'];
	$username=$_POST['username'];

	$date=date("Y-m-d");

	$playListInsetQuery=mysqli_query($con,"INSERT INTO playlists VALUES(NULL,'$name','$username','$date')");

	if(!$playListInsetQuery)
	{
		echo 'mysql erro';
	}


}
else
{
	echo 'Name and username not passed correctly';
}

 ?>