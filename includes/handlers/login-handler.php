<?php

if (isset($_POST['loginButton']))
{
	$username=$_POST['loginUsername'];
	$password=$_POST['loginPassword'];

	// Loging function
	$res=$acc->login($username,$password);
	if ($res)
	{
		$_SESSION['UserLoggedin']=$username;
		header("Location:index.php");
		
	}
}
