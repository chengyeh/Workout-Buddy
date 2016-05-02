<?php
require_once('../includes/initialize.php');

?>
<?php
include('header.html');
?>
<!-- html goes here -->
<h1 class="page-header">Exercise Testing</h1>
<h3 class="sub-header">Test for Adding Exercise Set to Exercise and Routine Exercises</h3>
<p>This test will test if an exercise set is tied in with a routine and an exercise to be querried.</p>
&nbsp;
<p>Following code will test if the exercise set can be created.</p>
<div class="well">
<xmp>
			$rout_ex_set = new Routine();
		    $rout_ex_set->user_id = 19;
		    $rout_ex_set->name = "Test Routine for Set and Exercise";
		    $rout_ex_set->description = "This Routine is for Testing Purposes";
		   	$rout_ex_set->mon = 1;
		    $rout_ex_set->start_date = '2016-05-01';
		    $rout_ex_set->end_date = '2016-06-01';
			$rout_ex_set->create();


			$ex_set=new Exercises();
			$ex_set->routine_id=$rout_ex_set->id;
			$ex_set->type=10;
			$ex_set->create();

			$test_set=new Set();
			$test_set->exercise_id=$ex_set->id;
			$test_set->routine_id=$rout_ex_set->id;
			$test_set->order=1;
			$test_set->reps=10;
			$test_set->weight=30;


   			global $database;
			$sql = "SELECT * FROM wb_exercise_set WHERE routine_id=".$rout_ex_set->id." AND exercise_id=".$ex_set->id;
			$ex_set_test_array = $database->query($sql);
			$pass_trigger=0;
	    	while($test_set_array = $ex_set_test_array->fetch_assoc())
			{
					$set_array=Set::find_by_id($test_set_array['id']);

					echo "<strong>The id of the set object is : </strong>";
					echo $test_set->id;
					echo "<br>";
					echo "<strong>The id that was queried was  : </strong>";
					echo $set_array->id;
					if(($set_array->id)==($test_set->id))
					{
						$pass_trigger=1;
					}

			}

	</xmp>
</div>
<p>Result:</p>
<div class="well" style="background-color: #e6f7ff;">
	<?php

		    $rout_ex_set = new Routine();
		    $rout_ex_set->user_id = 19;
		    $rout_ex_set->name = "Test Routine for Set and Exercise";
		    $rout_ex_set->description = "This Routine is for Testing Purposes";
		   	$rout_ex_set->mon = 1;
		    $rout_ex_set->start_date = '2016-05-01';
		    $rout_ex_set->end_date = '2016-06-01';
			$rout_ex_set->create();


			$ex_set=new Exercises();
			$ex_set->routine_id=$rout_ex_set->id;
			$ex_set->type=10;
			$ex_set->create();

			$test_set=new Set();
			$test_set->exercise_id=$ex_set->id;
			$test_set->routine_id=$rout_ex_set->id;
			$test_set->order=1;
			$test_set->reps=10;
			$test_set->weight=30;
			global $database;
			$database->query("INSERT INTO `wb_exercise_set`(`exercise_id`, `routine_id`, `order`, `reps`, `weight`) VALUES ($test_set->exercise_id,$test_set->routine_id,$test_set->order,$test_set->reps,$test_set->weight)");
			$test_set->id = $database->insert_id();


			global $database;
			$sql = "SELECT * FROM wb_exercise_set WHERE routine_id=".$rout_ex_set->id." AND exercise_id=".$ex_set->id;
			$ex_set_test_array = $database->query($sql);
			$pass_trigger=0;
	    	while($test_set_array = $ex_set_test_array->fetch_assoc())
			{
					$set_array=Set::find_by_id($test_set_array['id']);

					echo "<strong>The id of the set object is : </strong>";
					echo $test_set->id;
					echo "<br>";
					echo "<strong>The id that was queried was  : </strong>";
					echo $set_array->id;
					if(($set_array->id)==($test_set->id))
					{
						$pass_trigger=1;
					}

			}

	?>
	</div>
	<p>Status:</p>
	<div class="well" style="background-color: #e6f7ff;">
	<?php

		if($pass_trigger==1)
		{
			echo "<strong>Passed</strong>";
		}
		else
		{
			echo "<strong>Failed</strong>";
		}


	?>
	</div>






<?php
include('footer.html');
?>
