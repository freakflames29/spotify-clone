<?php 

include '../../config.php';
if(!isset($_POST['username']))
{
	echo 'Error username is not set';
	exit();
}
if(isset($_POST['emailIs'])&&$_POST['emailIs']!="")
{
	$email=$_POST['emailIs'];
	$username=$_POST['username'];

	// filtering the email
	if(!filter_var($email,FILTER_VALIDATE_EMAIL))
	{
		echo 'Invalid email';
		exit();
	}
	// checking the email is already being used or not
	$emailCheck=mysqli_query($con,"SELECT email FROM users WHERE email='$email' AND username !='$username'");
	if (!$emailCheck)
	{
		echo 'SQL ERROR';
		exit();
		
	}
	if(mysqli_num_rows($emailCheck)>0)
	{
			echo 'Email already in use';
			exit();
	}
	$update_Query=mysqli_query($con,"UPDATE users SET email ='$email' WHERE username='$username'");
	if($update_Query)
	{
		echo 'Succesfully updated';
		exit();
	}
	
}
else
{
	echo 'You must provide an email';
}

 ?>