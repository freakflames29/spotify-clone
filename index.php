<?php
include 'includes/config.php';
		
if (isset($_SESSION['UserLoggedin'])) 
{
	$userNAME=$_SESSION['UserLoggedin'];
	

}
else {
	header("Location:register.php");
}

echo 'Hello ';

?>