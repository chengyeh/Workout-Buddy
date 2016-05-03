<?php
require_once('../includes/initialize.php');

?>
<?php
include('header.html');
?>
<!-- html goes here -->
<h1 class="page-header">Exercise Set Testing</h1>
<h3 class="expand sub-header">Test for Adding Exercise Set to Exercise and Routine Exercises</h3>

<div class="well" style="display:none;">
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
			$database->query("INSERT INTO `wb_exercise_set`(`exercise_id`, `routine_id`, `order`, `reps`, `weight`) VALUES ($test_set->exercise_id,$test_set->routine_id,$test_set->order,$test_set->reps,$test_set->weight)");
			$test_set->id = $database->insert_id();


			global $database;
			$sql = "SELECT * FROM wb_exercise_set WHERE routine_id=".$rout_ex_set->id." AND exercise_id=".$ex_set->id;
			$ex_set_test_array = $database->query($sql);
			$pass_trigger=0;
	    	while($test_set_array = $ex_set_test_array->fetch_assoc())
			{
					$set_array=Set::find_by_id($test_set_array['id']);
					if(($set_array->id)==($test_set->id))
					{
						$pass_trigger=1;
					}

			}

		if($pass_trigger==1)
		{
			echo "<div class='well' style='background-color: #00ff00'>";
				echo "<strong>Passed</strong>";
				echo "</div>";
		}
		else
		{
			echo "<div class='well' style='background-color: #ff0000'>";
				echo "<strong>Failed</strong>";
				echo "</div>";
		}


	</xmp>
</div>

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
					if(($set_array->id)==($test_set->id))
					{
						$pass_trigger=1;
					}

			}

		if($pass_trigger==1)
		{
			echo "<div class='well' style='background-color: #00ff00'>";
				echo "<strong>Passed</strong>";
				echo "</div>";
		}
		else
		{
			echo "<div class='well' style='background-color: #ff0000'>";
				echo "<strong>Failed</strong>";
				echo "</div>";
		}

	?>




<h3 class="expand sub-header">Test for Displaying Exercise Set</h3>

<div class="well" style="display:none;">
<xmp>



   			global $database;
			$sql = "SELECT * FROM wb_exercise_set WHERE routine_id=".$rout_ex_set->id." AND exercise_id=".$ex_set->id;
			$ex_set_test_array = $database->query($sql);
			$pass_trigger=1;
	    	while($test_set_array = $ex_set_test_array->fetch_assoc())
			{
					$set_array=Set::find_by_id($test_set_array['id']);

					if(($set_array->exercise_id)!=($test_set->exercise_id))
					{
						$pass_trigger=0;
					}
					if(($set_array->routine_id)!=($test_set->routine_id))
					{
						$pass_trigger=0;
					}
					if(($set_array->order)!=($test_set->order))
					{
						$pass_trigger=0;
					}
					if(($set_array->reps)!=($test_set->reps))
					{
						$pass_trigger=0;
					}
					if(($set_array->weight)!=($test_set->weight))
					{
						$pass_trigger=0;
					}


			}

			if($pass_trigger==1)
			{
				echo "<strong>Passed</strong>";
			}
			else
			{
				echo "<strong>Failed</strong>";
			}

	</xmp>
</div>

	<?php

		   global $database;
			$sql = "SELECT * FROM wb_exercise_set WHERE routine_id=".$rout_ex_set->id." AND exercise_id=".$ex_set->id;
			$ex_set_test_array = $database->query($sql);
			$pass_trigger=1;
	    	while($test_set_array = $ex_set_test_array->fetch_assoc())
			{
					$set_array=Set::find_by_id($test_set_array['id']);

					if(($set_array->exercise_id)!=($test_set->exercise_id))
					{
						$pass_trigger=0;
					}
					if(($set_array->routine_id)!=($test_set->routine_id))
					{
						$pass_trigger=0;
					}
					if(($set_array->order)!=($test_set->order))
					{
						$pass_trigger=0;
					}
					if(($set_array->reps)!=($test_set->reps))
					{
						$pass_trigger=0;
					}
					if(($set_array->weight)!=($test_set->weight))
					{
						$pass_trigger=0;
					}


			}

			if($pass_trigger==1)
			{
				echo "<div class='well' style='background-color: #00ff00'>";
				echo "<strong>Passed</strong>";
				echo "</div>";
			}
			else
			{
				echo "<div class='well' style='background-color: #ff0000'>";
				echo "<strong>Failed</strong>";
				echo "</div>";
			}

	?>


	<h3 class="expand sub-header">Test for Editing Exercise Set</h3>

<div class="well" style="display:none;">
<xmp>



			$new_reps=15;
			$new_weight=40;
			global $database;
			$database->query("UPDATE `wb_exercise_set` SET `reps`=$new_reps, `weight`=$new_weight WHERE exercise_id=".$test_set->exercise_id." AND `order`=".$test_set->order." AND routine_id=".$test_set->routine_id);

   			global $database;
			$sql = "SELECT * FROM wb_exercise_set WHERE routine_id=".$rout_ex_set->id." AND exercise_id=".$ex_set->id;
			$ex_set_test_array = $database->query($sql);

			$pass_trigger=1;
	    	while($test_set_array = $ex_set_test_array->fetch_assoc())
			{
					$set_array=Set::find_by_id($test_set_array['id']);
					if(($set_array->reps)!=($new_reps))
					{
						$pass_trigger=0;
					}
					if(($set_array->weight)!=($new_weight))
					{
						$pass_trigger=0;
					}
					if(($set_array->id)!=($test_set->id))
					{
						$pass_trigger=0;
					}


			}

			if($pass_trigger==1)
			{
				echo "<div class='well' style='background-color: #00ff00'>";
				echo "<strong>Passed</strong>";
				echo "</div>";
			}
			else
			{
				echo "<div class='well' style='background-color: #ff0000'>";
				echo "<strong>Failed</strong>";
				echo "</div>";
			}


	</xmp>
</div>

	<?php

		  	$new_reps=15;
			$new_weight=40;

			$database->query("UPDATE `wb_exercise_set` SET `reps`=$new_reps, `weight`=$new_weight WHERE exercise_id=".$test_set->exercise_id." AND `order`=".$test_set->order." AND routine_id=".$test_set->routine_id);

   			global $database;
			$sql = "SELECT * FROM wb_exercise_set WHERE routine_id=".$rout_ex_set->id." AND exercise_id=".$ex_set->id;
			$ex_set_test_array = $database->query($sql);

			$pass_trigger=1;
	    	while($test_set_array = $ex_set_test_array->fetch_assoc())
			{
					$set_array=Set::find_by_id($test_set_array['id']);
					if(($set_array->reps)!=($new_reps))
					{
						$pass_trigger=0;
					}
					if(($set_array->weight)!=($new_weight))
					{
						$pass_trigger=0;
					}
					if(($set_array->id)!=($test_set->id))
					{
						$pass_trigger=0;
					}


			}

			if($pass_trigger==1)
			{
				echo "<div class='well' style='background-color: #00ff00'>";
				echo "<strong>Passed</strong>";
				echo "</div>";
			}
			else
			{
				echo "<div class='well' style='background-color: #ff0000'>";
				echo "<strong>Failed</strong>";
				echo "</div>";
			}

	?>

		<h3 class="expand sub-header">Test for Deleting Exercise Set</h3>

<div class="well" style="display:none;">
<xmp>

			$temp_exercise_id=$rout_ex_set->id;
			$temp_routine_id=$rout_ex_set->id;


			global $database;
			$database->query("DELETE FROM wb_exercise_set WHERE routine_id = '" . $rout_ex_set->id . "'");
			$database->query("DELETE FROM wb_exercise WHERE routine_id = '" . $rout_ex_set->id . "'");
			$rout_ex_set->delete();


   			global $database;
			$sql = "SELECT * FROM wb_exercise_set WHERE routine_id=".$temp_routine_id." AND exercise_id=".$temp_exercise_id;
			$ex_set_test_array = $database->query($sql);
			$del_track=0;
			$pass_trigger=1;
	    	while($test_set_array = $ex_set_test_array->fetch_assoc())
			{
					$del_track++;


			}

			if($del_track==0)
			{
				echo "<div class='well' style='background-color: #00ff00'>";
				echo "<strong>Passed</strong>";
				echo "</div>";
			}
			else
			{
				echo "<div class='well' style='background-color: #ff0000'>";
				echo "<strong>Failed</strong>";
				echo "</div>";
			}


	</xmp>
</div>

	<?php

		  	$temp_exercise_id=$rout_ex_set->id;
			$temp_routine_id=$rout_ex_set->id;


			global $database;
			$database->query("DELETE FROM wb_exercise_set WHERE routine_id = '" . $rout_ex_set->id . "'");
			$database->query("DELETE FROM wb_exercise WHERE routine_id = '" . $rout_ex_set->id . "'");
			$rout_ex_set->delete();


   			global $database;
			$sql = "SELECT * FROM wb_exercise_set WHERE routine_id=".$temp_routine_id." AND exercise_id=".$temp_exercise_id;
			$ex_set_test_array = $database->query($sql);
			$del_track=0;
			$pass_trigger=1;
	    	while($test_set_array = $ex_set_test_array->fetch_assoc())
			{
					$del_track++;


			}

			if($del_track==0)
			{
				echo "<div class='well' style='background-color: #00ff00'>";
				echo "<strong>Passed</strong>";
				echo "</div>";
			}
			else
			{
				echo "<div class='well' style='background-color: #ff0000'>";
				echo "<strong>Failed</strong>";
				echo "</div>";
			}
	?>






<?php
include('footer.html');
?>
