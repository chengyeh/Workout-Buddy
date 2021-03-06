<?php
require_once('../includes/initialize.php');

?>
<?php
include('header.html');
?>

<h1 class="page-header">Routine Testing</h1>
<h3 class="expand sub-header">Test for creating a routine</h3>

<div class="well" style="display:none;">
<xmp>
//This test creates a routine

date_default_timezone_set('America/Chicago');
$dt = new DateTime();
$tz = new DateTimeZone('America/Chicago');
$rout = new Routine();
$rout->user_id = 19;
$rout->name = "Test Routine";
$rout->description = "This Routine is for Testing Purposes";
$rout->mon = 1;
$rout->tues = 0;
$rout->wed = 1;
$rout->thurs = 0;
$rout->fri = 1;
$rout->sat = 0;
$rout->sun = 0;
$rout->start_date = escape_value("2016-05-01 00:00:00");
$rout->end_date = escape_value("2016-05-31 00:00:00");
$rout->create();

global $database;
$sql = "SELECT * FROM wb_routine WHERE id=".$rout->id;
$routine_test_array = $database->query($sql);

while($routine_array = $routine_test_array->fetch_assoc())
{
		$rout_testcreate_array=Routine::find_by_id($routine_array['id']);


		if($rout->id==$rout_testcreate_array->id)
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

}


	</xmp>
</div>

	<?php


	$rout = new Routine();
    $rout->user_id = 19;
    $rout->name = "Test Routine";
    $rout->description = "This Routine is for Testing Purposes";
   	$rout->mon = 1;
   	$rout->tues = 0;
   	$rout->wed = 1;
   	$rout->thurs = 0;
   	$rout->fri = 1;
   	$rout->sat = 0;
   	$rout->sun = 0;
    $rout->start_date='2016-05-01';
	$rout->end_date='2016-05-31';
	$rout->create();

	global $database;
	$sql = "SELECT * FROM wb_routine WHERE id=".$rout->id;
	$routine_test_array = $database->query($sql);

	    	while($routine_array = $routine_test_array->fetch_assoc())
			{
					$rout_testcreate_array=Routine::find_by_id($routine_array['id']);


					if($rout->id==$rout_testcreate_array->id)
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

			}
	?>


<h3 class="expand sub-header">Test for querying an individual routine</h3>

<div class="well" style="display:none;">
<xmp>
//This test demonstrates the querying or displaying of a routine object

global $database;
$sql = "SELECT * FROM wb_routine WHERE id=".$rout->id;
$group_member_array = $database->query($sql);
$pass_trigger=1;
while($log_array = $group_member_array->fetch_assoc())
{

			$set_array=Routine::find_by_id($log_array['id']);
			if(($set_array->user_id)!=$rout->user_id)
			{
				$pass_trigger=0;
			}

			if(($set_array->name)!=$rout->name)
			{
				$pass_trigger=0;
			}
			if(($set_array->description)!=$rout->description)
			{
				$pass_trigger=0;
			}
			if(($set_array->mon)!=$rout->mon)
			{
				$pass_trigger=0;
			}
			if(($set_array->tues)!=$rout->tues)
			{
				$pass_trigger=0;
			}
			if(($set_array->thurs)!=$rout->thurs)
			{
				$pass_trigger=0;
			}
			if(($set_array->wed)!=$rout->wed)
			{
				$pass_trigger=0;
			}
			if(($set_array->fri)!=$rout->fri)
			{
				$pass_trigger=0;
			}
			if(($set_array->sat)!=$rout->sat)
			{
				$pass_trigger=0;
			}
			if(($set_array->sun)!=$rout->sun)
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


	global $database;
    	$sql = "SELECT * FROM wb_routine WHERE id=".$rout->id;
    	$group_member_array = $database->query($sql);
    	$pass_trigger=1;
    	while($log_array = $group_member_array->fetch_assoc())
		{

					$set_array=Routine::find_by_id($log_array['id']);
					if(($set_array->user_id)!=$rout->user_id)
					{
						$pass_trigger=0;
					}

					if(($set_array->name)!=$rout->name)
					{
						$pass_trigger=0;
					}
					if(($set_array->description)!=$rout->description)
					{
						$pass_trigger=0;
					}
					if(($set_array->mon)!=$rout->mon)
					{
						$pass_trigger=0;
					}
					if(($set_array->tues)!=$rout->tues)
					{
						$pass_trigger=0;
					}
					if(($set_array->thurs)!=$rout->thurs)
					{
						$pass_trigger=0;
					}
					if(($set_array->wed)!=$rout->wed)
					{
						$pass_trigger=0;
					}
					if(($set_array->fri)!=$rout->fri)
					{
						$pass_trigger=0;
					}
					if(($set_array->sat)!=$rout->sat)
					{
						$pass_trigger=0;
					}
					if(($set_array->sun)!=$rout->sun)
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


	<h3 class="expand sub-header">Test for editing a routine</h3>

<div class="well" style="display:none;">
<xmp>
//This test demonstrates the editing or updating the fields of an existing routine object

$rout2=Routine::find_by_id($rout->id);

$rout2->description="This workout is going to be fun!";
$rout2->mon=1;
$rout2->thurs=1;
$rout2->sat=1;
$rout2->wed=0;
$rout2->fri=0;
$rout2->end_date='2016-05-15';
$rout2->update();

global $database;
$sql = "SELECT * FROM wb_routine WHERE id=".$rout->id;
$group_member_array = $database->query($sql);
$pass_trigger=1;
while($log_array = $group_member_array->fetch_assoc())
{

	$set_array=Routine::find_by_id($log_array['id']);
	if(($set_array->user_id)!=$rout2->user_id)
	{
		$pass_trigger=0;
	}

	if(($set_array->name)!=$rout->name)
	{
		$pass_trigger=0;
	}
	if(($set_array->description)!=$rout2->description)
	{
		$pass_trigger=0;
	}
	if(($set_array->mon)!=$rout2->mon)
	{
		$pass_trigger=0;
	}
	if(($set_array->tues)!=$rout->tues)
	{
		$pass_trigger=0;
	}
	if(($set_array->thurs)!=$rout2->thurs)
	{
		$pass_trigger=0;
	}
	if(($set_array->wed)!=$rout2->wed)
	{
		$pass_trigger=0;
	}
	if(($set_array->fri)!=$rout2->fri)
	{
		$pass_trigger=0;
	}
	if(($set_array->sat)!=$rout2->sat)
	{
		$pass_trigger=0;
	}
	if(($set_array->sun)!=$rout2->sun)
	{
		$pass_trigger=0;
	}

}
f($pass_trigger==1)
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


		$rout2=Routine::find_by_id($rout->id);

    	$rout2->description="This workout is going to be fun!";
    	$rout2->mon=1;
    	$rout2->thurs=1;
    	$rout2->sat=1;
    	$rout2->wed=0;
    	$rout2->fri=0;
    	$rout2->end_date='2016-05-15';
    	$rout2->update();

    	global $database;
    	$sql = "SELECT * FROM wb_routine WHERE id=".$rout->id;
    	$group_member_array = $database->query($sql);
    	$pass_trigger=1;
    	while($log_array = $group_member_array->fetch_assoc())
		{

					$set_array=Routine::find_by_id($log_array['id']);
					if(($set_array->user_id)!=$rout2->user_id)
					{
						$pass_trigger=0;
					}

					if(($set_array->name)!=$rout->name)
					{
						$pass_trigger=0;
					}
					if(($set_array->description)!=$rout2->description)
					{
						$pass_trigger=0;
					}
					if(($set_array->mon)!=$rout2->mon)
					{
						$pass_trigger=0;
					}
					if(($set_array->tues)!=$rout->tues)
					{
						$pass_trigger=0;
					}
					if(($set_array->thurs)!=$rout2->thurs)
					{
						$pass_trigger=0;
					}
					if(($set_array->wed)!=$rout2->wed)
					{
						$pass_trigger=0;
					}
					if(($set_array->fri)!=$rout2->fri)
					{
						$pass_trigger=0;
					}
					if(($set_array->sat)!=$rout2->sat)
					{
						$pass_trigger=0;
					}
					if(($set_array->sun)!=$rout2->sun)
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

		<h3 class="expand sub-header">Test for querying all routines</h3>

<div class="well" style="display:none;">
<xmp>
//This test demonstrates the querying or displaying of all routines associated with a user object

$rout1 = new Routine();
$rout1->user_id = 19;
$rout1->name = "Fun Routine";
$rout1->create();

$rout2 = new Routine();
$rout2->user_id = 19;
$rout2->name = "Weekend Routine";
$rout2->create();
$user = User::find_by_id($rout1->user_id);

$all_routine_array=$user->exercise_routines_added();
echo "<strong>The routines that the user has are: </strong>";
echo "<br>";
foreach ($all_routine_array as $routine_object)
{
	$a=$a+1;
	cou
}
if($a==3)
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


		$rout1 = new Routine();
		    $rout1->user_id = 19;
		    $rout1->name = "Fun Routine";
			$rout1->create();

		    $rout2 = new Routine();
		    $rout2->user_id = 19;
		    $rout2->name = "Weekend Routine";
			$rout2->create();
			$user = User::find_by_id($rout1->user_id);

		    $all_routine_array=$user->exercise_routines_added();
		    $a=0;
		    foreach ($all_routine_array as $routine_object)
			{

				$a=$a+1;
			}
			if($a==3)
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

			<h3 class="expand sub-header">Test for deleting routines</h3>

<div class="well" style="display:none;">
<xmp>
//This test demonstrates the deletion of an existing routine object

$user = User::find_by_id(19);

$all_routine_array=$user->exercise_routines_added();
echo "<strong>The routines that the are remaining are: </strong>";
echo "<br>";
$a=0;
foreach ($all_routine_array as $routine_object)
{

	$routine_object->delete();

}
$all_routine_array=$user->exercise_routines_added();
foreach ($all_routine_array as $routine_object)
{

	$a=$a+1;

}
if($a != 0)
{
	echo "There are remaining routines in the database";
}
else
{
	echo "There are no remaining routines in the database";
}

	</xmp>
</div>

	<?php


		$user = User::find_by_id(19);

		    $all_routine_array=$user->exercise_routines_added();

		    $a=0;
		    foreach ($all_routine_array as $routine_object)
			{

				$routine_object->delete();

			}
			$all_routine_array=$user->exercise_routines_added();
			foreach ($all_routine_array as $routine_object)
			{

				$a=$a+1;

			}
			if($a != 0)
			{
				echo "<div class='well' style='background-color: #ffd6cc'>";
							echo "<strong>FAILED</strong>";
							echo "</div>";
			}
			else
			{
				echo "<div class='well' style='background-color: #b3ffcc'>";
						echo "<strong>PASSED</strong>";
						echo "</div>";
			}
	?>

<?php
include('footer.html');
?>
