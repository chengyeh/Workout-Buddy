<?php
require_once('includes/initialize.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
	// Validate the email address:
	if (!empty($_POST['email'])) {
		$e = $database->escape_value($_POST['email']);
	} else {
		$e = FALSE;
		echo '<p class="alert alert-error">You forgot to enter your email address!</p>';
	}
	
	// Validate the password:
	if (!empty($_POST['password'])) {
		$p = $database->escape_value($_POST['password']);
	} else {
		$p = FALSE;
		echo '<p class="alert alert-error">You forgot to enter your password!</p>';
	}
	
	if ($e && $p) { // If everything's OK.

		// Query the database:
		$found_user = User::authenticate($e, $p);
		
		if ($found_user) { // A match was made
			// Register the values:
			$session->login($found_user);
		    
		    //log_action('Login', "{$found_user->username} logged in.");
		    
			redirect_to("profile.php");
				
		} else { // No match was made.
			echo '<p class="alert alert-error">Either the email address and password entered do not match those on file or you have not yet activated your account.</p>';
		}
		
	} else { // If everything wasn't OK.
		echo '<p class="alert alert-error">Please try again.</p>';
	}
	
} // End of SUBMIT conditional.
?>
<!DOCTYPE div PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title>Workout Buddy: Login</title>
</head>
<body>
<h2>Login</h2>
	<form action="login.php" method="post" enctype="multipart/form-data">
		<label>Email Address</label>
		<input type="email" name="email" required autofocus />
		<label>Password</label>
		<input type="password" name="password" required />
		<button type="submit"  name="submit">Login</button>    
	</form>
	<p><a href="forgot_password.php">Forgot your password?</a></p>
	<p><a href="signup.php">Sign Up</a></p>
</body>
</html>
          
          
	</div>
</div>
