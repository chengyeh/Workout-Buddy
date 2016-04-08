<?php
/**
 * Obtains users Username and Password. The database is queried and a hashed password is compared to in order ensure correct credentials.
 */
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
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Workout Buddy - Login</title>

    <!-- Bootstrap core CSS -->
    <link href="dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="dist/css/signin.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">
	  <a href="index.html"><img alt="workout buddy logo" src="images/Workout_Buddy_Logo.png" class="center-block"></a>
      <form class="form-signin" action="login.php" method="post" enctype="multipart/form-data">
        <h2 class="form-signin-heading">Please Sign In</h2>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" id="inputEmail" class="form-control" placeholder="Email address" name="email" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Password"  name="password" required>
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Sign in</button>
        <br/>
        <p><a class="btn btn-lg btn-success btn-block" href="signup.php" role="button">Sign up</a></p>
      </form>

    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
