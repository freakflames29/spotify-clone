<?php


// password sanitizing for html input tag
function passwordSantize($input)
{
    $input = strip_tags($input);
    return $input;
}
// username sanitize for html input and converting it first charector to uppercase
function usernameSantize($input)
{
    $input = strip_tags($input);
    $input = str_replace(" ", "", $input);
    $input = ucfirst(strtolower($input));
    return $input;
}
// string sanitize for html input and converting it first charector to uppercase


function stringSantize($input)
{
    $input = strip_tags($input);
    $input = str_replace(" ", "", $input);
    $input = ucfirst(strtolower($input));
    return $input;
}




if (isset($_POST['register'])) {
    //just calling the function
    $username = usernameSantize($_POST['Username']);

    $firstname = stringSantize($_POST['firstName']);
    // echo $firstname;
    $lastname = stringSantize($_POST['lastName']);

    $email = stringSantize($_POST['email']);

    $email2 = stringSantize($_POST['email2']);

    $password = passwordSantize($_POST['password']);

    $cpassword = passwordSantize($_POST['cpassword']);
	
	$wasSucc=$acc->register($username,$firstname,$lastname,$email,$email2,$password,$cpassword);
    if($wasSucc)
    {
        $_SESSION['UserLoggedin']=$username;
        
        header("Location:index.php");
        
    }
    
}
