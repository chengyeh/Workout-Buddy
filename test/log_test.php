<?php
require_once('../includes/initialize.php');

?>
<?php
include('header.html');
?>
		    <h1 class="page-header">Log Testing</h1>
<h3 class="expand sub-header">Test for creating a category for a log</h3>

<div class="well" style="display:none;">
<xmp>
//This test creates a category of a log which is associated with a routine object and its corresponding routine exercise objects

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
	echo "<div class='well' style='background-color: #b3ffcc'>";
		echo "<strong>PASSED</strong>";
		echo "</div>";
}
else
{
	echo "<div class='well' style='background-color: #ffd6cc'>";
		echo "<strong>FAILED</strong>";
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
			echo "<div class='well' style='background-color: #b3ffcc'>";
				echo "<strong>PASSED</strong>";
				echo "</div>";
		}
		else
		{
			echo "<div class='well' style='background-color: #ffd6cc'>";
				echo "<strong>FAILED</strong>";
				echo "</div>";
		}

	?>


<h3 class="expand sub-header">Test for creating a log</h3>

<div class="well" style="display:none;">
<xmp>
//This test demonstrates how to create a log which is assocated with a category

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
	echo "<div class='well' style='background-color: #b3ffcc'>";
		echo "<strong>PASSED</strong>";
		echo "</div>";
}
else
{
	echo "<div class='well' style='background-color: #ffd6cc'>";
		echo "<strong>FAILED</strong>";
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
			echo "<div class='well' style='background-color: #b3ffcc'>";
				echo "<strong>PASSED</strong>";
				echo "</div>";
		}
		else
		{
			echo "<div class='well' style='background-color: #ffd6cc'>";
				echo "<strong>FAILED</strong>";
				echo "</div>";
		}



	?>




	<h3 class="expand sub-header">Test for querying a log: log_exercises1()</h3>

<div class="well" style="display:none;">
<xmp>
//This test demonstrates how to query fields from a log object

//The function used in this test is:
public function log_exercises1()
{
	global $database;
	$sql = "SELECT * FROM wb_user_log WHERE category_id=".$this->id." AND user_id=".$this->user_id;
	$log_array = $database->query($sql);
	return $log_array;
}

$log_test_array = $test_category->log_exercises1();
$pass_trigger=1;
foreach($log_test_array as $value)
{

	if(($value['id'])!=($test_log->id))
	{
		$pass_trigger=0;
	}
	if(($value['routine_id'])!=($test_rout->id))
	{
		$pass_trigger=0;
	}
	if(($value['exercise_id'])!=($test_ex->id))
	{
		$pass_trigger=0;
	}
	if(($value['reps'])!=($test_log->reps))
	{
		$pass_trigger=0;
	}

}

if($pass_trigger==1)
{
	echo "<div class='well' style='background-color: #b3ffcc'>";
		echo "<strong>PASSED</strong>";
		echo "</div>";
}
else
{
	echo "<div class='well' style='background-color: #ffd6cc'>";
		echo "<strong>FAILED</strong>";
		echo "</div>";
}


	</xmp>
</div>

	<?php



			$log_test_array = $test_category->log_exercises1();
			$pass_trigger=1;
			foreach($log_test_array as $value)
			{

				if(($value['id'])!=($test_log->id))
				{
					$pass_trigger=0;
				}
				if(($value['routine_id'])!=($test_rout->id))
				{
					$pass_trigger=0;
				}
				if(($value['exercise_id'])!=($test_ex->id))
				{
					$pass_trigger=0;
				}
				if(($value['reps'])!=($test_log->reps))
				{
					$pass_trigger=0;
				}

			}

			if($pass_trigger==1)
			{
				echo "<div class='well' style='background-color: #b3ffcc'>";
					echo "<strong>PASSED</strong>";
					echo "</div>";
			}
			else
			{
				echo "<div class='well' style='background-color: #ffd6cc'>";
					echo "<strong>FAILED</strong>";
					echo "</div>";
			}



	?>

		<h3 class="expand sub-header">Test for obtaining minimum values for a log</h3>

<div class="well" style="display:none;">
<xmp>
//This test demonstrates how to obtain the minimum values of a certain exercise type of log information of a user

$test_log2 = new Log();
$test_log2->user_id = 19;
$test_log2->routine_id = $test_rout->id;
$test_log2->exercise_id = $test_ex->id;
$test_log2->exercise_type_id = $test_ex->type;
$test_log2->set_id=$test_set->id;
$test_log2->reps = 20;
$test_log2->weight = 70;
$test_log2->date = $dt->format('m-d-Y');
$test_log2->time = $dt->format('H:i:s');
$test_log2->category_id = $test_category->id;
$test_log2->create();


global $database;
$sql = "SELECT MIN(weight) FROM wb_user_log WHERE exercise_type_id =".$test_log->exercise_type_id;
$log_comp_array = $database->query($sql);
$test_log2 = new Log();
$test_log2->user_id = 19;
$test_log2->routine_id = $test_rout->id;
$test_log2->exercise_id = $test_ex->id;
$test_log2->exercise_type_id = $test_ex->type;
$test_log2->set_id=$test_set->id;
$test_log2->reps = 20;
$test_log2->weight = 70;
$test_log2->date = $dt->format('m-d-Y');
$test_log2->time = $dt->format('H:i:s');
$test_log2->category_id = $test_category->id;
$test_log2->create();


global $database;
$sql = "SELECT MIN(weight) FROM wb_user_log WHERE exercise_type_id =".$test_log->exercise_type_id." AND user_id =".$test_log->user_id;

$pass_trigger=0;


$result_3 = $database->query($sql);

$row_3 = $result_3->fetch_assoc();

$min_weight = $row_3["MIN(weight)"];
if($min_weight==$test_log->weight)
{
	$pass_trigger=1;
}


if($pass_trigger==1)
{
	echo "<div class='well' style='background-color: #b3ffcc'>";
		echo "<strong>PASSED</strong>";
		echo "</div>";
}
else
{
	echo "<div class='well' style='background-color: #ffd6cc'>";
		echo "<strong>FAILED</strong>";
		echo "</div>";
}


	</xmp>
</div>

	<?php


			$test_log2 = new Log();
	        $test_log2->user_id = 19;
	        $test_log2->routine_id = $test_rout->id;
	        $test_log2->exercise_id = $test_ex->id;
	        $test_log2->exercise_type_id = $test_ex->type;
	        $test_log2->set_id=$test_set->id;
	        $test_log2->reps = 20;
	        $test_log2->weight = 70;
	        $test_log2->date = $dt->format('m-d-Y');
	        $test_log2->time = $dt->format('H:i:s');
	        $test_log2->category_id = $test_category->id;
	        $test_log2->create();


			global $database;
			$sql = "SELECT MIN(weight) FROM wb_user_log WHERE exercise_type_id =".$test_log->exercise_type_id." AND user_id =".$test_log->user_id;

			$pass_trigger=0;


			$result_3 = $database->query($sql);

        $row_3 = $result_3->fetch_assoc();

        $min_weight = $row_3["MIN(weight)"];
		if($min_weight==$test_log->weight)
		{
			$pass_trigger=1;
		}


		if($pass_trigger==1)
		{
			echo "<div class='well' style='background-color: #b3ffcc'>";
				echo "<strong>PASSED</strong>";
				echo "</div>";
		}
		else
		{
			echo "<div class='well' style='background-color: #ffd6cc'>";
				echo "<strong>FAILED</strong>";
				echo "</div>";
		}



	?>


	<h3 class="expand sub-header">Test for obtaining maximum values for a log</h3>

<div class="well" style="display:none;">
<xmp>
//This test demonstrates how to obtain the maximum values of a certain exercise type of log information of a user


global $database;
$sql = "SELECT MAX(weight) FROM wb_user_log WHERE exercise_type_id =".$test_log->exercise_type_id." AND user_id =".$test_log->user_id;

$pass_trigger=0;


$result_max = $database->query($sql);

$row_max = $result_max->fetch_assoc();

$max_weight = $row_max["MAX(weight)"];
if($max_weight==$test_log2->weight)
{
	$pass_trigger=1;
}


if($pass_trigger==1)
{
	echo "<div class='well' style='background-color: #b3ffcc'>";
		echo "<strong>PASSED</strong>";
		echo "</div>";
}
else
{
	echo "<div class='well' style='background-color: #ffd6cc'>";
		echo "<strong>FAILED</strong>";
		echo "</div>";
}


	</xmp>
</div>

	<?php




			global $database;
			$sql = "SELECT MAX(weight) FROM wb_user_log WHERE exercise_type_id =".$test_log->exercise_type_id." AND user_id =".$test_log->user_id;

			$pass_trigger=0;


			$result_max = $database->query($sql);

	        $row_max = $result_max->fetch_assoc();

	        $max_weight = $row_max["MAX(weight)"];
			if($max_weight==$test_log2->weight)
			{
				$pass_trigger=1;
			}


			if($pass_trigger==1)
			{
				echo "<div class='well' style='background-color: #b3ffcc'>";
					echo "<strong>PASSED</strong>";
					echo "</div>";
			}
			else
			{
				echo "<div class='well' style='background-color: #ffd6cc'>";
					echo "<strong>FAILED</strong>";
					echo "</div>";
			}



	?>


	<?php

			$test_log2->delete();
			$test_log->delete();
			$test_set->delete();
			$test_category->delete();
			$test_rout->delete();


	?>


<?php
include('footer.html');
?>
