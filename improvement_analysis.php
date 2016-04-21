<?php
//error checking
error_reporting(E_ALL);
ini_set("display_errors", 1);

//check if user logged in; if not, throw it back to login page
require_once('includes/initialize.php');
if(!$session->is_logged_in()){ redirect_to("login.php"); }

function dateDiff ($d1, $d2) {
// Return the number of days between the two dates:
  return round(abs(strtotime($d1)-strtotime($d2))/86400);
}
//find user id
$user = User::find_by_id($session->user_id);
$user = $user->id;





?>
<html>
  <head></head>
  <body>
    haha!<br>
    <?php
    global $database;
    //pull out all the diffrent workouts from the user
    $sql_1 = "SELECT DISTINCT exercise_type_id FROM `wb_user_log` WHERE user_id LIKE '". $user . "';";
    $array_exercise;

    $result_1 = $database->query($sql_1);
    while($row_1 = $result_1->fetch_assoc()){
      $exercise_id = $row_1["exercise_type_id"];  // this will get different workout that the user have; type Int

      //pull out the workout names
      $sql_2 = "SELECT name FROM `wb_exercise_type` WHERE id = '". $exercise_id. "';";
      $result_2 = $database->query($sql_2);
      $row_2 = $result_2->fetch_assoc();
      echo $row_2["name"] . "<br>";
    }


     ?>





  </body>

</html>
