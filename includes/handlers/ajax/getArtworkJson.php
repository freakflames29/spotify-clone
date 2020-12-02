<?php

	
include '../../config.php';

if(isset($_POST['artworkId']))
{
	$artworkId=$_POST['artworkId'];
	$artworkQ=mysqli_query($con,"SELECT * FROM albums WHERE id='$artworkId'");

	$resultArr=mysqli_fetch_array($artworkQ);

	echo json_encode($resultArr);
}



?>