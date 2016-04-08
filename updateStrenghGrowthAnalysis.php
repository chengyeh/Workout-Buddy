<?php
//error checking
error_reporting(E_ALL);
ini_set("display_errors", 1);

//check if user logged in; if not, throw it back to login page
require_once('includes/initialize.php');
if(!$session->is_logged_in()){ redirect_to("login.php"); }

//$challenge = challenge::find_by_id($_GET['id']);

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
  $errors = array();

  $sga = new strenghGrowthAnalysis();
  //if the user have not created a record before
  $sga->who = $trimmed['user_id'];
  $sga->name = $trimmed['challenge_name'];
  $sga->bench_press = $trimmed['challenge_BP_lbs'];
  $sga->pull_ups = $trimmed['challenge_PU_num'];
  $sga->treadmill_mileage = $trimmed['challenge_TMM'];


  //Redirect to profile page
  redirect_to("view_group.php?id={$database->insert_id()}");
}//end if
?>


<html>
  <head>
    <title>Workout Buddy: Strength Analysis</title>
  </head>
  <body>

    <h1>Profile Page: Add accomplished challenge</h1>
    <p><a href="profile.php">Profile</a>|<a href="logout.php">logout</a></p>
    <h2>User Info</h2>
  	<?php
  		echo "<p>User Name: " . $session->user_name. "</p>";
  		echo "<p>User Id: " . $session->user_id . "</p>";
  	?>
    <h2>Update your strength</h2>
      <table>
        <form action="#" method="post" enctype="multipart/form-data">
        <input type="hidden" name="user_id" value='<?php echo $session->user_id; ?>'>
        <tr><td><label>Your current bench press (lbs):</label></td><td><input type="text" name="sga_BP_lbs" required /></td></tr>
        <tr><td><label>You current max numbers of pull ups (#):</label></td><td><input type="text" name="sga_pull_up" required /></td></tr>
        <tr><td><label>Your current longest run (miles):</label></td><td><input type="text" name="sga_tmm" required /></td></tr>
      </table>
  </body>
</html>
