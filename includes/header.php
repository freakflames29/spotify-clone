<?php
include 'includes/config.php';
include 'includes/classes/Artist.php';
include 'includes/classes/Album.php';
include 'includes/classes/Song.php';

if (isset($_SESSION['UserLoggedin'])) {
	$userNAME = $_SESSION['UserLoggedin'];
}
// else {
//     header("Location:register.php");
// }

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Welcome to Spotify</title>
	<link rel="stylesheet" href="includes/assets/style/style.css">
</head>

<body>
	<div id="mainContainer">
		<!-- top part container -->

		<div id="topContainer">
			<!-- nav bar -->
			<?php include("includes/navbar.php"); ?>

			<!-- main view container -->
			<div id="mainViewContainer">

				<div id="mainContent">