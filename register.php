<?php
include("includes/config.php");
include("includes/classes/Account.php");
include("includes/classes/Consta.php");
$acc = new Account($con);
include("includes/handlers/register-handler.php");
include("includes/handlers/login-handler.php");
function getName($name)
{
	if (isset($_POST[$name])) {
		echo $_POST[$name];
	}
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Register</title>
	<link rel="stylesheet" type="text/css" href="includes/assets/style/register.css">
</head>

<body>
	<div id="background">
		<div id="loginContainer">
			<div id="inputContainer">
				<form action="register.php" method="post" id="loginForm">
					<h2>Login your account</h2>
					<p>
						<?php echo $acc->getError(Consta::$loginFailed); ?>

						<label for="loginUsername">Username</label>
						<input type="text" id="loginUsername" placeholder="Username" name="loginUsername" value="<?php getName('loginUsername')?>" required>

					</p>
					<p>
						<label for="loginPassword">Password</label>

						<input type="password" id="loginPassword" name="loginPassword" placeholder="Password"  required>
					</p>
					<button type="submit" name="loginButton">Login</button>

					<div class="hasAccounttext">
						<span id="hideLogin">Don't have a account? Sign up here.</span>
					</div>


				</form>

				<!-- register form -->
				<form action="register.php" method="post" id="registerForm">
					<h2>Create a free account </h2>
					<p>
						<?php echo $acc->getError(Consta::$UsernameRes); ?>
						<?php echo $acc->getError(Consta::$UsernameTaken); ?>
						<!--showing err by php-->
						<label for="Username">Username</label>
						<input type="text" id="Username" placeholder="Username" name="Username" value="<?php getName('Username') ?>" required>

					</p>
					<p>
						<?php echo $acc->getError(Consta::$FirstNameRes); ?>

						<label for="firstName">First Name</label>
						<input type="text" id="firstName" placeholder="firstName" name="firstName" value="<?php getName('firstName') ?>" required>

					</p>
					<p>

						<?php echo $acc->getError(Consta::$LastNameRes); ?>

						<label for="lastName">Last Name</label>
						<input type="text" id="lastName" placeholder="lastName" name="lastName" value="<?php getName('lastName') ?>" required>

					</p>

					<p>
						<?php echo $acc->getError(Consta::$InvalidEmail); ?>
						<?php echo $acc->getError(Consta::$EmailNotMatching); ?>
						<?php echo $acc->getError(Consta::$EmailTaken); ?>

						<label for="email">Email</label>

						<input type="email" id="email" name="email" placeholder="Email" value="<?php getName('email') ?>" required>
					</p>
					<p>
						<label for="email2">Confirm Email</label>
						<input type="email" id="email2" placeholder="confirm Email" name="email2" value="<?php getName('email') ?>" required>

					</p>
					<p <?php echo $acc->getError(Consta::$PasswordNotMatching); ?> <?php echo $acc->getError(Consta::$PasswordAlpha); ?> <?php echo $acc->getError(Consta::$PasswordRes); ?> <label for="password">Password</label>
						<input type="password" id="password" placeholder="password" name="password" required>

					</p>
					<p>
						<label for="cpassword">Confirm Password</label>
						<input type="password" id="cpassword" placeholder="Confirm password" name="cpassword" required>

					</p>


					<button type="submit" name="register">Signup</button>

					<div class="hasAccounttext">
						<span id="hideRegister">Already have an account! Login here </span>
					</div>


				</form>
			</div>
			<div id="loginText">
				<h1>Get great music,right now</h1>
				<h2>Listen to loads of songs for free</h2>
				<ul>
					<li>Discover music you will fall in love with</li>
					<li>Create your own playlists</li>
					<li>Follow artist to keep uptodate</li>
				</ul>

			</div>
		</div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="includes/assets/js/register.js"></script>
	<?php
	if (isset($_POST['register'])) {
		echo '	<script>
		$("#loginForm").hide();
		$("#registerForm").show();
	</script>';
	} else {
		echo '	<script>
		$("#loginForm").show();
		$("#registerForm").hide();
	</script>';
	}
	?>

</body>

</html>