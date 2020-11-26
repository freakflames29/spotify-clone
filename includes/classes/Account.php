<?php

class Account
{
	private $con;
	private $errorArray;
	public function __construct($con)
	{
		$this->con = $con;
		$this->errorArray = array();
	}
	public function login($un,$pw)
	{
		$verifyEncPass=md5($pw);
		$LoginSQL="SELECT * FROM users WHERE username='$un' AND password='$verifyEncPass'";
		$loginRes=mysqli_query($this->con,$LoginSQL);
		if (mysqli_num_rows($loginRes)==1)
		{
			return true;
			
		}
		else
		{
			// also show error message for login failed
			array_push($this->errorArray,Consta::$loginFailed);
			return false;
		}

		
	}
	public function register($username, $firstname, $lastname, $email, $email2, $password, $cpassword)
	{
		$this->usernameValidate($username);
		$this->firstnameVal($firstname);
		$this->lastnameVal($lastname);
		$this->emailsVal($email, $email2);
		$this->passVal($password, $cpassword);

		if (empty($this->errorArray) == true) {
			return $this->insertData($username, $firstname, $lastname, $email, $password); //if true then insert into Db
		} else {
			return false;
		}
	}
	// outputting error messages
	public function getError($err)
	{
		if (!in_array($err, $this->errorArray)) {
			$err = "";
		}
		return "<span class='errorMes'>$err</span>";
	}
	// for inserting data in DB function
	private function insertData($un, $fn, $ln, $em, $pw)
	{
		$encPw = md5($pw);
		$profilePic = "assets/images/profile-pics/head_emerald.png";
		$date = date("Y-m-d");
		// $sql = "INSERT INTO users VALUES ('','$un','$fn','$ln','$em','$encPw','$date','$profilePic')";
		// $sq = "SELECT * FROM users";.
		$sq = "INSERT INTO users VALUES(NULL,'$un','$fn','$ln','$em','$encPw','$date','$profilePic')";
		$result = mysqli_query($this->con, $sq);

		return $result;
	}

	// validating the form
	private function usernameValidate($un)
	{
		if (strlen($un) > 10 || strlen($un) < 5) {
			array_push($this->errorArray, Consta::$UsernameRes);
			return;
		}

		//TODO:check username exists	
		$usernameSQL = "SELECT username FROM users WHERE username='$un'";
		$usernameQuery = mysqli_query($this->con, $usernameSQL);
		if (mysqli_num_rows($usernameQuery) > 0) {
			array_push($this->errorArray, Consta::$UsernameTaken);
			return;
		}
	}
	private function firstnameVal($fn)
	{
		if (strlen($fn) > 15 || strlen($fn) < 2) {
			array_push($this->errorArray, Consta::$FirstNameRes);
			return;
		}
	}
	private function lastnameVal($ln)
	{
		if (strlen($ln) > 10 || strlen($ln) < 2) {
			array_push($this->errorArray, Consta::$LastNameRes);
			return;
		}
	}
	//~ chefking email validation
	private function emailsVal($em, $em2)
	{
		if ($em !== $em2) {
			array_push($this->errorArray, Consta::$EmailNotMatching);
			return;
		}
		if (!filter_var($em, FILTER_VALIDATE_EMAIL)) {
			array_push($this->errorArray, Consta::$InvalidEmail);
			return;
		}
		//TODO:check username already being used
		$EmailSQL = "SELECT email FROM users WHERE email='$em'";
		$EmailQuery = mysqli_query($this->con, $EmailSQL);
		if (mysqli_num_rows($EmailQuery) > 0) {
			array_push($this->errorArray, Consta::$EmailTaken);
			return;
		}
	}
	// password validation with pregmatch
	private function passVal($pass, $cpass)
	{
		if ($pass !== $cpass) {
			array_push($this->errorArray, Consta::$PasswordNotMatching);
			return;
		}
		if (preg_match('/[^A-Za-z0-9]/', $pass)) {
			array_push($this->errorArray, Consta::$PasswordAlpha);
			return;
		}

		if (strlen($pass) > 15 || strlen($pass) <= 8) {
			array_push($this->errorArray, Consta::$PasswordRes);
			return;
		}
	}
}
