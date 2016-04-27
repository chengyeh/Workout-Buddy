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
//Create User object from ID in the URL


?>
<html>
  <head></head>
  <body>
    <br>
    <?php
    global $database;




    //pull out all the diffrent workouts from the user
    $sql_1 = "SELECT DISTINCT exercise_type_id FROM `wb_user_log` WHERE user_id LIKE '". $user . "';";
    $array_exercise;

    $result_1 = $database->query($sql_1);

    echo "<table><tr><td> You have done the following:   </td><td>Your Max:</td><td>Your worst:</td><td>Your strengh is growing at:   </td><td>Between:    </td></tr>";
    while($row_1 = $result_1->fetch_assoc()){

      echo "<tr>";
      // this will get different workout that the user have; type Int
      $exercise_id = $row_1["exercise_type_id"];

      //pull out the workout names
      $sql_2 = "SELECT name FROM `wb_exercise_type` WHERE id = '". $exercise_id. "';";
      $result_2 = $database->query($sql_2);
      $row_2 = $result_2->fetch_assoc();
      echo "<td>".  $row_2["name"] ."</td>";

      //pull out the minimum weight (weakest workout) record
      $sql_3 = "SELECT MIN(weight), date FROM `wb_user_log` WHERE (exercise_type_id = '". $exercise_id . "' ) AND (user_id = '". $user ."');";
      $sql_31 = "SELECT MIN(date), date FROM `wb_user_log` WHERE (exercise_type_id = '". $exercise_id . "' ) AND (user_id = '". $user ."');";
      $result_3 = $database->query($sql_3);
      $result_31 = $database->query($sql_31);
      $row_3 = $result_3->fetch_assoc();
      $row_31 = $result_31->fetch_assoc();
      $min_weight = $row_3["MIN(weight)"];


      $d1 = $row_31["MIN(date)"];
      $d1 = str_replace('-', '/', $d1); // change format
      $d1 = strtotime($d1);


      //pull out the maximum weight (weakest workout) record
      $sql_4 = "SELECT MAX(weight), date FROM `wb_user_log` WHERE (exercise_type_id = '". $exercise_id . "' ) AND (user_id = '". $user ."');";
      $sql_41 = "SELECT MAX(date), date FROM `wb_user_log` WHERE (exercise_type_id = '". $exercise_id . "' ) AND (user_id = '". $user ."');";
      $result_4 = $database->query($sql_4);
      $result_41 = $database->query($sql_41);
      $row_4 = $result_4->fetch_assoc();
      $row_41 = $result_41->fetch_assoc();
      $max_weight = $row_4["MAX(weight)"];
      echo "<td>".$max_weight." lb </td><td>".$min_weight." lb</td>";


      $d2 = $row_41["MAX(date)"];
      $d2 = str_replace('-', '/', $d2);
      $d2 = strtotime($d2);

      $days_between = ceil(abs($d2 - $d1) / 86400);

      $rate;
      //improvement rate
      if($days_between == 0){
        $rate = $max_weight - $min_weight;
        echo "<td>" . $rate . " lbs/day</td>";
      }
      else{
        $rate = ($max_weight - $min_weight) / $days_between;
        echo "<td>" . $rate . " lbs/day</td>";
      }
      //date
      echo "<td>From: ".$row_31["MIN(date)"]."<br>To: ".$row_41["MAX(date)"]."</td>";

    }


     ?>





  </body>

</html>
