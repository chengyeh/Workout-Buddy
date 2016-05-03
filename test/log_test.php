<?php
require_once('../includes/initialize.php');

?>
<?php
include('header.html');
?>
		    <h1 class="page-header">Log Testing</h1>
<h3 class="expand sub-header">Test for Creating a Category for a Log which is integrated with Routine and Routine Exercises</h3>

<div class="well" style="display:none;">
<xmp>

		 	date_default_timezone_set('America/Chicago');
		    $dt = new DateTime();
		    $tz = new DateTimeZone('America/Chicago');

		    $test_rout = new Routine();
		    $test_rout->user_id = 19;
		    $test_rout->name = "Test Routine for Category and Log";
		    $test_rout->description = "This Routine is for Testing Purposes for log_test.php";
		    $test_rout->mon = 1;
		    $test_rout->start_date = '2016-05-01';
		    $test_rout->end_date = '2016-06-01';
			$test_rout->create();


			$test_ex=new Exercises();
			$test_ex->routine_id=$rout_ex_set->id;
			$test_ex->type=10;
			$test_ex->create();

		    $test_category = new Category();
		    $test_category->user_id=19;
		    $test_category->routine_id=$test_rout->id;
		    $test_category->exercise_id = $test_ex->id;
		    $test_category->Date = $dt->format('m-d-Y');
		    $test_category->Time = $dt->format('H:i:s');
		    $test_category->create();


			global $database;
			$sql = "SELECT * FROM wb_log_category WHERE id=".$test_category->id;
			$cat_test_array = $database->query($sql);
			$pass_trigger=0;
	    	while($test_array = $cat_test_array->fetch_assoc())
			{
					$set_array=Category::find_by_id($test_array['id']);
					if(($set_array->id)==($test_category->id))
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

			date_default_timezone_set('America/Chicago');
		    $dt = new DateTime();
		    $tz = new DateTimeZone('America/Chicago');

		    $test_rout = new Routine();
		    $test_rout->user_id = 19;
		    $test_rout->name = "Test Routine for Category and Log";
		    $test_rout->description = "This Routine is for Testing Purposes for log_test.php";
		    $test_rout->mon = 1;
		    $test_rout->start_date = '2016-05-01';
		    $test_rout->end_date = '2016-06-01';
			$test_rout->create();


			$test_ex=new Exercises();
			$test_ex->routine_id=$rout_ex_set->id;
			$test_ex->type=10;
			$test_ex->create();

		    $test_category = new Category();
		    $test_category->user_id=19;
		    $test_category->routine_id=$test_rout->id;
		    $test_category->exercise_id = $test_ex->id;
		    $test_category->Date = $dt->format('m-d-Y');
		    $test_category->Time = $dt->format('H:i:s');
		    $test_category->create();


			global $database;
			$sql = "SELECT * FROM wb_log_category WHERE id=".$test_category->id;
			$cat_test_array = $database->query($sql);
			$pass_trigger=0;
	    	while($test_array = $cat_test_array->fetch_assoc())
			{
					$set_array=Category::find_by_id($test_array['id']);
					if(($set_array->id)==($test_category->id))
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


<h3 class="expand sub-header">Test for Creating a Log which is integrated with Category</h3>

<div class="well" style="display:none;">
<xmp>



			$a=1;
			$test_set=new Set();
			$test_set->exercise_id=$test_ex->id;
			$test_set->routine_id=$test_rout->id;
			$test_set->order=$a;
			$test_set->reps=10;
			$test_set->weight=30;
			global $database;
			$database->query("INSERT INTO `wb_exercise_set`(`exercise_id`, `routine_id`, `order`, `reps`, `weight`) VALUES ($test_set->exercise_id, $test_set->routine_id, $test_set->order ,$test_set->reps,$test_set->weight)");
			$test_set->id = $database->insert_id();

		 	$test_log = new Log();
	        $test_log->user_id = 19;
	        $test_log->routine_id = $test_rout->id;
	        $test_log->exercise_id = $test_ex->id;
	        $test_log->exercise_type_id = $test_ex->type;
	        $test_log->set_id=$test_set->id;
	        $test_log->reps = 20;
	        $test_log->weight = 40;
	        $test_log->date = $dt->format('m-d-Y');
	        $test_log->time = $dt->format('H:i:s');
	        $test_log->category_id = $test_category->id;
	        $test_log->create();

			global $database;
			$sql = "SELECT * FROM wb_user_log WHERE id=".$test_log->id;
			$log_test_array = $database->query($sql);
			$pass_trigger=0;
	    	while($test_array = $log_test_array->fetch_assoc())
			{
					$set_array=Log::find_by_id($test_array['id']);
					if(($set_array->id)==($test_log->id))
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

			$a=1;
			$test_set=new Set();
			$test_set->exercise_id=$test_ex->id;
			$test_set->routine_id=$test_rout->id;
			$test_set->order=$a;
			$test_set->reps=10;
			$test_set->weight=30;
			global $database;
			$database->query("INSERT INTO `wb_exercise_set`(`exercise_id`, `routine_id`, `order`, `reps`, `weight`) VALUES ($test_set->exercise_id, $test_set->routine_id, $test_set->order ,$test_set->reps,$test_set->weight)");
			$test_set->id = $database->insert_id();

		 	$test_log = new Log();
	        $test_log->user_id = 19;
	        $test_log->routine_id = $test_rout->id;
	        $test_log->exercise_id = $test_ex->id;
	        $test_log->exercise_type_id = $test_ex->type;
	        $test_log->set_id=$test_set->id;
	        $test_log->reps = 20;
	        $test_log->weight = 40;
	        $test_log->date = $dt->format('m-d-Y');
	        $test_log->time = $dt->format('H:i:s');
	        $test_log->category_id = $test_category->id;
	        $test_log->create();

			global $database;
			$sql = "SELECT * FROM wb_user_log WHERE id=".$test_log->id;
			$log_test_array = $database->query($sql);
			$pass_trigger=0;
	    	while($test_array = $log_test_array->fetch_assoc())
			{
					$set_array=Log::find_by_id($test_array['id']);
					if(($set_array->id)==($test_log->id))
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




	<h3 class="expand sub-header">Test for Displaying a Log</h3>

<div class="well" style="display:none;">
<xmp>





			global $database;
			$sql = "SELECT * FROM wb_user_log WHERE id=".$test_log->id;
			$log_test_array = $database->query($sql);
			$pass_trigger=1;
	    	while($test_array = $log_test_array->fetch_assoc())
			{
					$set_array=Log::find_by_id($test_array['id']);
					if(($set_array->id)!=($test_log->id))
					{
						$pass_trigger=0;
					}
					if(($set_array->routine_id)!=($test_rout->id))
					{
						$pass_trigger=0;
					}
					if(($set_array->exercise_id)!=($test_ex->id))
					{
						$pass_trigger=0;
					}
					if(($set_array->reps)!=($test_log->reps))
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

			global $database;
			$sql = "SELECT * FROM wb_user_log WHERE id=".$test_log->id;
			$log_test_array = $database->query($sql);
			$pass_trigger=1;
	    	while($test_array = $log_test_array->fetch_assoc())
			{
					$set_array=Log::find_by_id($test_array['id']);
					if(($set_array->id)!=($test_log->id))
					{
						$pass_trigger=0;
					}
					if(($set_array->routine_id)!=($test_rout->id))
					{
						$pass_trigger=0;
					}
					if(($set_array->exercise_id)!=($test_ex->id))
					{
						$pass_trigger=0;
					}
					if(($set_array->reps)!=($test_log->reps))
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



<?php
include('footer.html');
?>
