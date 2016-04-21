<?php

//=========== SET TIMEZONE =======================
date_default_timezone_set('America/Denver');

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

    //echo "<table><tr><td>".$user."has done the following:</td><td>Overall Improvement rate:</td><td>Between:</td></tr>";
    while($row_1 = $result_1->fetch_assoc()){
      $exercise_id = $row_1["exercise_type_id"];  // this will get different workout that the user have; type Int

      //pull out the workout names
      $sql_2 = "SELECT name FROM `wb_exercise_type` WHERE id = '". $exercise_id. "';";
      $result_2 = $database->query($sql_2);
      $row_2 = $result_2->fetch_assoc();
      echo $row_2["name"] . "<br>";

      //pull out the minimum weight (weakest workout) record
      $sql_3 = "SELECT MIN(weight), date FROM `wb_user_log` WHERE (exercise_type_id = '". $exercise_id . "' ) AND (user_id = '". $user ."');";
      $result_3 = $database->query($sql_3);
      $row_3 = $result_3->fetch_assoc();
      echo "Min weight: " . $row_3["MIN(weight)"] . "<br>";
      echo "Min weight date: " .$row_3["date"] . "<br>";

      $d1 = $row_3["date"];
      $d1 = str_replace('-', '/', $d1); // change format
      $d1 = strtotime($d1);

      //pull out the maximum weight (weakest workout) record
      $sql_4 = "SELECT MAX(weight), date FROM `wb_user_log` WHERE (exercise_type_id = '". $exercise_id . "' ) AND (user_id = '". $user ."');";
      $result_4 = $database->query($sql_4);
      $row_4 = $result_4->fetch_assoc();
      echo "Max weight: " . $row_4["MAX(weight)"] . "<br>";
      echo "Max weight date: " .$row_4["date"] . "<br>";

      $d2 = $row_4["date"];
      $d2 = str_replace('-', '/', $d2);
      $d2 = strtotime($d2);

      $days_between = ceil(abs($d2 - $d1) / 86400);
      echo "Days between: ". $days_between . "<br>";
    }


     ?>





  </body>

</html>
