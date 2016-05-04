<?php
require_once('../includes/initialize.php');

?>
<?php
include('header.html');
?>
<!-- html goes here -->
<h1 class="page-header">Exercise Testing</h1>
<h3 class="expand sub-header">Test for showing number of exercises</h3>

<div class="well" style="display:none;">
<xmp>



			public function show_types()
		   {
		    	$sql = "SELECT * FROM wb_exercise_type";
		    	$types_object_array = Types::find_by_sql($sql);
		    	return $types_object_array;
		    }
		    $a=1;
			$var_types = Types::find_by_id(1);
			$display_types=$var_types->show_types();
			foreach($display_types as $display_feature)
			{

					$a=$a+1;

			}

			//Since there are 285 exercises to choose from in the database table wb_exercise_type, the output should be 285 for $a

	</xmp>
</div>

	<?php


	$a=0;
			$var_types = Types::find_by_id(1);
			$display_types=$var_types->show_types();
			foreach($display_types as $display_feature)
			{
					$a=$a+1;

			}

			if($a==285)
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


<h3 class="expand sub-header">est for Displaying the Right Name for an Exercise</h3>
<div class="well" style="display:none;">
<xmp>
			$a=1;
			$var_types = Types::find_by_id(1);
			$display_types=$var_types->show_types();
			//The 10th exercise in the database is Barbell Deadlifts. As a result, this test will see if it will display the name of that correctly
			$echo_display_name;
			foreach($display_types as $display_feature)
			{

					if($a==10)
					{
						echo "<strong>".$display_feature->name."</strong>";

						$echo_display_name=$display_feature->name;
						$reference_id=$display_feature->id;
					}
					$a=$a+1;

			}

			$test_name="Barbell Deadlifts";
			if(strcasecmp($echo_display_name,$test_name)==0)
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
			$var_types = Types::find_by_id(1);
			$display_types=$var_types->show_types();
			//The 10th exercise in the database is Barbell Deadlifts. As a result, this test will see if it will display the name of that correctly
			$echo_display_name;
			foreach($display_types as $display_feature)
			{

					if($a==10)
					{


						$echo_display_name=$display_feature->name;
						$reference_id=$display_feature->id;
					}
					$a=$a+1;

			}

			$test_name="Barbell Deadlifts";
			if(strcasecmp($echo_display_name,$test_name)==0)

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



<h3 class="expand sub-header">Test for Adding an Exercise to a Routine</h3>
<div class="well" style="display:none;">
<xmp>



			$rout_ex = new Routine();
		    $rout_ex->user_id = 19;
		    $rout_ex->name = "Test Routine for Exercise";
		    $rout_ex->description = "This Routine is for Testing Purposes";
		   	$rout_ex->mon = 1;
		    $rout_ex->start_date = '2016-05-01';
		    $rout_ex->end_date = '2016-06-01';
			$rout_ex->create();


			$ex=new Exercises();
			$ex->routine_id=$rout_ex->id;
			$ex->type=$reference_id;
			$ex->create();

			global $database;
			$sql = "SELECT * FROM wb_exercise WHERE routine_id=".$rout_ex->id;
			$ex_rout_test_array = $database->query($sql);

	    	while($ex_rout_array = $ex_rout_test_array->fetch_assoc())
			{
					$test_array=Exercises::find_by_id($ex_rout_array['id']);

					echo "<strong>The id of the routine : </strong>";
					echo "<br>";
					echo $rout_ex->id;
					echo "<br>";
					echo "<strong>The routine_id for the exercise that was queried for the designated routine was: </strong>";
					echo "<br>";
					echo $test_array->routine_id;
					echo "<br>";

					if($test_array->routine_id==$rout_ex->id)
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

			}
	</xmp>
</div>

	<?php



			$rout_ex = new Routine();
		    $rout_ex->user_id = 19;
		    $rout_ex->name = "Test Routine for Exercise";
		    $rout_ex->description = "This Routine is for Testing Purposes";
		   	$rout_ex->mon = 1;
		    $rout_ex->start_date = '2016-05-01';
		    $rout_ex->end_date = '2016-06-01';
			$rout_ex->create();


			$ex=new Exercises();
			$ex->routine_id=$rout_ex->id;
			$ex->type=$reference_id;
			$ex->create();

			global $database;
			$sql = "SELECT * FROM wb_exercise WHERE routine_id=".$rout_ex->id;
			$ex_rout_test_array = $database->query($sql);

	    	while($ex_rout_array = $ex_rout_test_array->fetch_assoc())
			{
					$test_array=Exercises::find_by_id($ex_rout_array['id']);



					if($test_array->routine_id==$rout_ex->id)
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

			}

	?>



	<h3 class="expand sub-header">Test for Deleting Exercises</h3>
<div class="well" style="display:none;">
<xmp>



			$database->query("DELETE FROM wb_exercise WHERE routine_id = '" . $rout_ex->id . "'");
		$rout_ex->delete();

		global $database;
			$sql = "SELECT * FROM wb_exercise WHERE routine_id=".$rout_ex->id;
			$ex_rout_test_array = $database->query($sql);
			$a=0;
			foreach ($ex_rout_test_array as $ex_object)
			{

				$a=$a+1;

			}
			if($a == 0)
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


			$database->query("DELETE FROM wb_exercise WHERE routine_id = '" . $rout_ex->id . "'");
			$rout_ex->delete();
			global $database;
			$sql = "SELECT * FROM wb_exercise WHERE routine_id=".$rout_ex->id;
			$ex_rout_test_array = $database->query($sql);
			$a=0;
			foreach ($ex_rout_test_array as $ex_object)
			{

				$a=$a+1;

			}
			if($a == 0)
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
