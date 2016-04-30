<?php
require_once('../includes/initialize.php');

?>
<?php
include('header.html');
?>
<!-- html goes here -->
<h1 class="page-header">Exercise Testing</h1>
<h3 class="sub-header">Test for Displaying Right number of Exercises</h3>
<p>This test will test if an exercise type is available so that the user can select for an exercise.</p>
&nbsp;
<p>Following code will test whether it can query the type for a designated exercise.</p>
<div class="well">
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

					echo "hi";
					$a=$a+1;

			}
			//Since there are 285 exercises to choose from in the database table wb_exercise_type, the output should be 285 for $a



	</xmp>
</div>
<p>Result:</p>
<div class="well" style="background-color: #e6f7ff;">
	<?php

		    $a=0;
			$var_types = Types::find_by_id(1);
			$display_types=$var_types->show_types();
			foreach($display_types as $display_feature)
			{
					$a=$a+1;

			}
			echo "<strong>The number of exercises in wb_exercise_type are: </strong>";
			echo $a;
			echo "<br>";

	?>
	</div>
	<p>Status:</p>
	<div class="well" style="background-color: #e6f7ff;">
	<?php

		if($a==285)
		{
			echo "<strong>Passed</strong>";
		}
		else
		{
			echo "<strong>Failed</strong>";
		}


	?>
	</div>


<h3 class="sub-header">Test for Displaying the Write Name for an Exercise</h3>
<p>This test will test if an that is being displayed is queried right from the wb_exercise_type table.</p>
&nbsp;
<p>Following code will test whether it can send a query for a designated exercise.</p>
<div class="well">
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
			//The 10th exercise in the database is Barbell Deadlifts. As a result, this test will see if it will display the name of that correctly
			$echo_display_name;
			foreach($display_types as $display_feature)
			{

					if($a==10)
					{
						echo $display_feature->name;
						$echo_display_name=$display_feature->name
					}
					$a=$a+1;

			}



	</xmp>
</div>
<p>Result:</p>
<div class="well" style="background-color: #e6f7ff;">
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
						echo $display_feature->name;
						$echo_display_name=$display_feature->name;
					}
					$a=$a+1;

			}

	?>
	</div>
	<p>Status:</p>
	<div class="well" style="background-color: #e6f7ff;">
	<?php

		$test_name="Barbell Deadlifts";
		if(strcasecmp($echo_display_name,$test_name)==0)
		{
			echo "Passed";
		}
		else
		{
			echo "Failed";
		}



	?>
	</div>





<?php
include('footer.html');
?>
