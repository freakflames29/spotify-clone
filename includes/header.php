<?php
include 'includes/config.php';
include 'includes/classes/Artist.php';
include 'includes/classes/Album.php';

include 'includes/classes/Song.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Welcome to Spotify</title>
	<link rel="stylesheet" href="includes/assets/style/style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script type="text/javascript" src="includes/assets/js/script.js"></script>
	
	<!-- <link rel="preconnect" href="https://fonts.gstatic.com"> -->
<!-- <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100&display=swap" rel="stylesheet"> -->

<?php

if (isset($_SESSION['UserLoggedin'])) {
    $userNAME = $_SESSION['UserLoggedin'];
    // echo $userNAME;
    echo "<script>userLoggedin ='".$userNAME."' ;console.log(userLoggedin);</script>";
}
else {
    header("Location:register.php");
}

?>




</head>

<body>
	<div id="mainContainer">
		<!-- top part container -->

		<div id="topContainer">
			<!-- nav bar -->
			<?php include "includes/navbar.php";?>

			<!-- main view container -->
			<div id="mainViewContainer">

				<div id="mainContent">