<?php
require_once('../includes/initialize.php');

?>
<?php
include('header.html');
?>
<!-- html goes here -->
<!-- html goes here -->
<h1 class="page-header">Routine Testing</h1>
<h3 class="sub-header">Test for creating a Routine</h3>
<p>This test will test to demonstrate how a user can create a routine.<br>The routine will include a user_id of 19. <br> The routine name is "Test Routine". <br>
The description is "This Routine is for Testing Purposes". <br> The days that the routine will occur will be on Monday, Wednesday and Friday. <br> The start date is May 1, 2016. <br> The end date is May 31, 2016</p>
&nbsp;
<p>Following code will test whether it can query the type for a designated routine.</p>
<div class="well">
<xmp>


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

	</xmp>
</div>
<p>Result:</p>
<div class="well" style="background-color: #e6f7ff;">
	<?php

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
		  	$rout->start_date='2016-05-01';
		  	$rout->end_date='2016-05-31';
			$rout->create();


			global $database;
	    	$sql = "SELECT * FROM wb_routine WHERE id=".$rout->id;
	    	$routine_test_array = $database->query($sql);
	    	echo "<strong>The routine that was queried to the database had: </strong>";

	    	while($routine_array = $routine_test_array->fetch_assoc())
			{

						$rout_testcreate_array=Routine::find_by_id($routine_array['id']);

						echo "<br>";
						echo "<strong>Name of routine tested is: </strong>";
						echo $rout_testcreate_array->name;
						echo "<br>";
						echo "<strong>Description of routine tested is: </strong>";
						echo $rout_testcreate_array->description;
						echo "<br>";
						echo "<strong>Days of the week that this routine tested are on: </strong>";
						if(($rout_testcreate_array->mon)==1)
					    {

							echo "Monday";
							echo "<br>";
					    }
					    if(($rout_testcreate_array->tues)==1)
					    {

							echo "Tuesday";
							echo "<br>";
					    }
					    if(($rout_testcreate_array->wed)==1)
					    {
					        echo "Wednesday";
							echo "<br>";
					    }
					    if(($rout_testcreate_array->thurs)==1)
					    {

							echo "Thursday";
							echo "<br>";
					    }
					    if(($rout_testcreate_array->fri)==1)
					    {

							echo "Friday";
							echo "<br>";
					    }
					    if(($rout_testcreate_array->sat)==1)
					    {

							echo "Saturday";
							echo "<br>";
					    }
					    if(($rout_testcreate_array->sun)==1)
					    {

							echo "Sunday";
							echo "<br>";
					    }

						echo "<strong>Start Date of tested routine: </strong>";
						echo $rout_testcreate_array->start_date;
						echo "<br>";
						echo "<strong>End Date of tested routine: </strong>";
						echo $rout_testcreate_array->end_date;
			}

	?>
	</div>
	<p>Status:</p>
	<div class="well" style="background-color: #e6f7ff;">
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
					/*
					if(($set_array->start_date)!=$rout->start_date)
					{
						$pass_trigger=0;
					}
					if(($set_array->end_date)!=$rout->end_date)
					{
						$pass_trigger=0;
					}
					*/
		}
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
