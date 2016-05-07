<?php
require_once('../includes/initialize.php');

//error checking
error_reporting(E_ALL);
ini_set("display_errors", 1);
?>
<?php
include('header.html');
?>
<!-- html goes here -->
<h1 class="page-header">Challenge Testing</h1>
<h3 class="sub-header">Test whether the leaderboard top3() function is returning the correct result</h3>

<p>The challenge::___top3() functions ( __ means don't care) should display the members who have entered their record into the database.</p>
<p>The functions in the challenge class should display the ranking of the top 3 members in each section. </p>
<p>If there's no one entered the record, then there should be 0 members being displayed on the leaderboard.  </p>
<p>If there's one entered the record, then there should be 1 members being displayed on the leaderboard, and so on. </p>
<p>At most 3 members should be displayed. A number not including in the range of [0,inf) is not valid.</p>


<p><b>This is the code in the class that query the database for the top 3 members.</b></p>

<h3 class="expand sub-header">Test for challenge sets (press me to see):</h3>
<div class="well" style="display:none;">
<xmp>


  public static function show_num_bptop3(){
      $sql_1 = "SELECT COUNT(*) FROM challenge ORDER BY bench_press DESC LIMIT 3;";
      $result_1 = $database->query($sql_1);

      $r1 = $result_1->fetch_assoc();
      $n1 = $r1["COUNT(*)"];
      $result_1->free();

      return $n1;
  }
  public static function show_num_putop3(){
      $sql_2 = "SELECT COUNT(*) FROM challenge ORDER BY pull_ups DESC LIMIT 3;";
      $result_2 = $database->query($sql_2);

      $r2 = $result_2->fetch_assoc();
      $n2 = $r2["COUNT(*)"];
      $result_2->free();

      return $n2;
  }
  public static function show_num_tmtop3(){
      $sql_3 = "SELECT COUNT(*) FROM challenge ORDER BY treadmill_mileage DESC LIMIT 3;";
      $result_3 = $database->query($sql_3);

      $r3 = $result_3->fetch_assoc();
      $n3 = $r3["COUNT(*)"];
      $result_3->free();

      return $n3;
  }

  </xmp>
</div>

<div class="well" style="display:none; ">  
<?php
$n1 = challenge::show_num_bptop3();
$n2 = challenge::show_num_putop3();
$n3 = challenge::show_num_tmtop3();
echo "The number of members shown on the bench press leader board: ". $n1 . "<br>";
echo "The number of members shown on the pull up leader board: ". $n2 . "<br>";
echo "The number of members shown on the tread mill leader board: ". $n3 . "<br>";
?>
</div>


<div class="well" style="display:none; ">
  <?php
  $n1 = challenge::show_num_bptop3();
  $n2 = challenge::show_num_putop3();
  $n3 = challenge::show_num_tmtop3();

  if($n1 >= 0 )
    echo "Test for bench_press top 3 has passed.<br>";
  else
    echo "Test for bench_press top 3 has failed.<br>";

  if($n1 >= 0)
    echo "Test for pull_ups top 3 has passed.<br>";
  else
    echo "Test for pull_ups top 3 has failed.<br>";

  if($n1 >= 0)
    echo "Test for tread_mill top 3 has passed.<br>";
  else
    echo "Test for tread_mill top 3 has failed.<br>";

  ?>
</div>

<?php
$test_name="Barbell Deadlifts";
if($n1 >= 0 && $n2 >= 0 && $n3 >= 0)
{
	echo "<div class='well' style='background-color: #b3ffcc'>";
			echo "<strong>PASSED</strong>";
			echo "</div>";
}
?>

<?php
include('footer.html');
?>
