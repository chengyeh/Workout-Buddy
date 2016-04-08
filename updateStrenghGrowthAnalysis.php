<?php
//error checking
error_reporting(E_ALL);
ini_set("display_errors", 1);

//check if user logged in; if not, throw it back to login page
require_once('includes/initialize.php');
if(!$session->is_logged_in()){ redirect_to("login.php"); }



if ($_SERVER['REQUEST_METHOD'] == 'POST'){
  $errors = array();

  $trimmed = array_map('trim', $_POST);

  $sga = new strenghGrowthAnalysis();
  $user = $trimmed['user_id'];
  $sql = "SELECT * FROM strenghGrowthAnalysis WHERE who LIKE '". $user . "';";

  //if the user have not created a record before
  /*
    now the mysqli_num_rows seems to be always less than 1, or == 0, check it out later.
  */
  if(mysqli_num_rows($sql) > 0){
    //if the user has created a record before
      $sql = "SELECT * FROM strenghGrowthAnalysis WHERE bench_press_now != 0.0 AND who LIKE '". $trimmed['user_id'] . "';";
      //if the user has updated before; anything that has _now must has value

      //if the user has not been updated before; _now does not have value
      if(mysqli_num_rows($sql) == 0){
        $sga->who = $trimmed['user_id'];
        $sga->bench_now = $trimmed['sga_BP_lbs'];
        $sga->pull_up_now = $trimmed['sga_pull_up'];
        $sga->treadmill_now = $trimmed['sga_tmm'];
        $sga->update();
      }
  }
  else{
    $sga->who = $trimmed['user_id'];
    $sga->bench_press_previous = $trimmed['sga_BP_lbs'];
    $sga->pull_up_previous = $trimmed['sga_pull_up'];
    $sga->treadmill_previous = $trimmed['sga_tmm'];
    $sga->create();
  }

  //Redirect to profile page
  redirect_to("view_group.php?id={$database->insert_id()}");
}//end if
?>


<html>
  <head>
    <title>Workout Buddy: Strength Analysis</title>
  </head>
  <body>

    <h1>Profile Page: Update your strength growth</h1>
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
        <tr><td><button type="submit" name="submit">Update your strength growth! WooHoo</button></td><td></td></tr>
      </table>
  </body>
</html>
