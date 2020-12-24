<?php 

include 'includes/includedFiles.php';

 ?>
 <div class="userDetails">
 	<div class="container borderBottom">
 		<h1>Email</h1>
 		<input type="text" class="email" name="email" placeholder="Email address..." value="<?php $userLoggedin->getUserEmail();?>">

 		<span class="mesage"></span>
 		<button class="button" onclick="updateEmail('email')">SAVE</button>
 		
 		
 	</div>
 	<div class="container">
 		<h1>Password</h1>
 		<input type="password" class="oldPassword" name="oldPassword1" placeholder="Current password">
 		<input type="password" class="newPassword1" name="newPassword1" placeholder="New password">
 		<input type="password" class="newPassword2" name="newPassword2" placeholder="Confirm password">

		<span class="mesage" ></span>
 		<button class="button" onclick="updatePassword('oldPassword','newPassword1','newPassword2')">SAVE</button>
 	</div>

 </div>