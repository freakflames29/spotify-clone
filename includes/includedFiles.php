 <?php 

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']))
{
	// echo 'CAME FROM AJAX';
	include 'includes/config.php';
	include 'includes/classes/Artist.php';
	include 'includes/classes/Album.php';
	include 'includes/classes/Song.php';

	
}
else
{
	include 'includes/header.php';
	include 'includes/footer.php';

	// so now the main content is not threr so we are calling the openPage function here to load the main content

	$urlOftheCurrentpage=$_SERVER['REQUEST_URI'];
	echo "<script>onPage('$urlOftheCurrentpage')</script>"; //this uses ajax but now our ajax has not included the files so we have to include the files
	exit();
	/* when the first time page loads the else block is executing and the content in index page is loaded so we have to close the ajax not to load the content another time*/
	
}


  ?>