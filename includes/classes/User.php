<?php 


class User
{
	private $con;
	private $username;

	public function __construct($con,$username)
	{
		$this->con=$con;
		$this->username=$username;

	}
	 public function getuserName()
	{
		return $this->username;
	}
	public function getUserEmail()
	{
		$Email_fetch_query=mysqli_query($this->con,"SELECT email FROM users WHERE username='$this->username'");
		$row= mysqli_fetch_array($Email_fetch_query);
		echo $row['email'];

		
	}
	public function getFullNameofUser()
	{
		$query=mysqli_query($this->con,"SELECT concat(firstname,' ',lastname) as 'name' FROM users WHERE username='$this->username'");
		if (!$query) 
		{
			echo 'Sql error';
			
		}
		$row=mysqli_fetch_array($query);
		
		return $row['name'];

	}
	

}

 ?>