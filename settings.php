<?php 

include 'includes/includedFiles.php';
?>
<div class="entityInfo">
	
<div class="centerSection">
	<div class="userInfo">
		<h1><?php echo $userLoggedin->getFullNameofUser();?></h1>
	</div>
</div>

<div class="buttonItems">
	<button class="button" onclick="onPage('updateDetails.php')">User Details</button>
	<button class="button" onclick="logout()">Logout</button>
</div>


</div>