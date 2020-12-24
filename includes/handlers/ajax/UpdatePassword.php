<?php 
include '../../config.php';

if (!isset($_POST['username']))
{
	echo 'ERRO username not set';
	exit();
}
if(!isset($_POST['oldPassword'])||!isset($_POST['newPassword1'])||!isset($_POST['newPassword2']))
{
	echo 'Password filed is not set';
	exit();
}
if($_POST['oldPassword']==""||$_POST['newPassword1']==""||$_POST['newPassword2']=="")
{
	echo 'Passwords are set null';
	exit();
}

$username=$_POST['username'];
$oldPassword=$_POST['oldPassword'];
$newPassword1=$_POST['newPassword1'];
$newPassword2=$_POST['newPassword2'];


$oldPassword_md5=md5($oldPassword);

$passwordCheck_query=mysqli_query($con,"SELECT * FROM users WHERE username='$username' AND password='$oldPassword_md5'");


if(mysqli_num_rows($passwordCheck_query)!=1)
{
	echo 'Password is incorrect';
	exit();
}
if ($newPassword1!=$newPassword2)
{
	echo 'Password is not matching';
	exit();
}
if (preg_match("/[^A-Za-z0-9]/",$newPassword1))
{
	echo 'Your password must only contain numbers and letters';
	exit();	
}
if (strlen($newPassword1)>30 || strlen($newPassword1)<8)
{
	echo 'Your password must be between 8-30 charectors';
	exit();
}

$newmd5=md5($newPassword1);
$password_update_query=mysqli_query($con,"UPDATE users SET password='$newmd5' WHERE username='$username'");
if($password_update_query)
{
	echo 'Updated succefully';
	exit();

}
else {
	echo 'sql eror';
	exit();
}


 ?>