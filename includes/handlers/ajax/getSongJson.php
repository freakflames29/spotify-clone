<?php

include '../../config.php';

if(isset($_POST['songId']))
{
	$sonId=$_POST['songId'];
	$songQ=mysqli_query($con,"SELECT * FROM songs WHERE id='$sonId'");

	$resultArr=mysqli_fetch_array($songQ);

	echo json_encode($resultArr);
}


?>