<!-- header part -->
<!-- and nav bar -->
<?php include 'includes/header.php';?>


<!-- The actual main content which varies page to page -->
<h1 class="pageHeadingBig">You also may Like</h1>

<!-- printing albums -->
<div class="gridviewContainer">


		<?php

$albumQuery = mysqli_query($con, "SELECT * FROM albums ORDER BY RAND() LIMIT 10");

while ($row = mysqli_fetch_array($albumQuery)) {
    
    echo "
    		
				<div class='gridViewItem'>		
					 <a href='albums.php?id=".$row['id']."''>

						<img src=" . $row['artworkPath'] . ">
						<div class='gridViewinfo'>" . $row['title'] . "</div>
					</a>

				</div>";

}

?>

</div>



















<!-- footer part -->
<!-- and playing bar -->
<?php include 'includes/footer.php';?>

