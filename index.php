	<!-- header part -->
<!-- and nav bar -->
<?php 
/*we have to delete the header.php from here because if we kept that and we are also  including includedFiles.php if the user enters the url manually it will load the header and here index.php also has a header.php so the content in header.php included twice and the included files in the header.php can not be reassigned,it will create a mess so that we are removing header.php from hrer*/

//include 'includes/header.php';

include 'includes/includedFiles.php';

?>


<!-- The actual main content which varies page to page -->
<h1 class="pageHeadingBig">You also may Like</h1>

<!-- printing albums -->
<div class="gridviewContainer">


<?php

$albumQuery = mysqli_query($con, "SELECT * FROM albums ORDER BY RAND() LIMIT 10");

while ($row = mysqli_fetch_array($albumQuery)) {

    echo "

					<div class='gridViewItem'>
						 <a href='albums.php?id=" . $row['id'] . "''>

							<img src=" . $row['artworkPath'] . ">
							<div class='gridViewinfo'>" . $row['title'] . "</div>
						</a>

					</div>";

}

?>

</div>



















<!-- footer part -->
<!-- and playing bar -->
<!-- <?php //include 'includes/footer.php';?> we have to hide this beacause we are including this thing in our includedFiles.php and there we included this file. now if we want to included this here our now playing bar will be  overridden by this and we can't control our songs -->
