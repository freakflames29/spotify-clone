<?php

	
include '../../config.php';

if(isset($_POST['artistId']))
{
	$artistId=$_POST['artistId'];
	$artistQ=mysqli_query($con,"SELECT * FROM artist WHERE id='$artistId'");

	$resultArr=mysqli_fetch_array($artistQ);

	echo json_encode($resultArr);
}



?>