	<!-- header part -->
<!-- and nav bar -->
<?php
/*we have to delete the header.php from here because if we kept that and we are also  including includedFiles.php if the user enters the url manually it will load the header and here index.php also has a header.php so the content in header.php included twice and the included files in the header.php can not be reassigned,it will create a mess so that we are removing header.php from hrer*/

//include 'includes/header.php';

include 'includes/includedFiles.php';

?>

<!-- moving index.php into browsw php -->

<!-- The actual main content which varies page to page -->

<!-- calling the browse page by ajax -->
<script >onPage("browse.php");</script>







<!-- footer part -->
<!-- and playing bar -->
<!-- <?php //include 'includes/footer.php';?> we have to hide this beacause we are including this thing in our includedFiles.php and there we included this file. now if we want to included this here our now playing bar will be  overridden by this and we can't control our songs -->
