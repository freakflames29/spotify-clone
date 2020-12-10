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

                             <span  role='link' tabindex='0' onclick='onPage(\"albums.php?id=" . $row['id'] . "\")'>
 
							<img src=" . $row['artworkPath'] . ">
							<div class='gridViewinfo'>" . $row['title'] . "</div>
						</span>

					</div>";

}

?>

</div>


