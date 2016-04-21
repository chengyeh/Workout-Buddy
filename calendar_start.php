<?php 
require_once('includes/initialize.php');

//To keep tack if the current Month/Year is same
//calendar show current Month/Year
//This is used highlight the currnt day in the calendar
$isCurrentMonth = false;

//Get all the post variables
$showmonth = $_POST['showmonth'];
$showyear = $_POST['showyear'];
$showday = $_POST['showday'];

//Prep all the post variables
$showmonth = preg_replace('#[^0-9]#i','',$showmonth);
$showmonth = sprintf("%02d", $showmonth);
$showyear = preg_replace('#[^0-9]#i','',$showyear);
$showday = preg_replace('#[^0-9]#i','',$showday);

//Determine if current month/year is same as
//show claendar current month/year 
$date = $showyear."-" .$showmonth;

//Set default time zone to central standard time
date_default_timezone_set("America/Chicago");

//Today's date year/month 
$today = date("Y-m");

//Today's date calendar date
$day = date("d");

//Determine if month same as calendar show month 
if($date == $today){
	$isCurrentMonth = true;
}

//Data about the month/days of the current month.
//This is used for display month.
$day_count = cal_days_in_month(CAL_GREGORIAN, $showmonth, $showyear);
$pre_days = date('w', mktime(0,0,0,$showmonth,1,$showyear));
$post_days = (6-(date('w', mktime(0,0,0,$showmonth,$day_count,$showyear))));

//Setup display month
echo '<div id="calendar_wrap">';
echo '<div class="title_bar">';
echo '<div class="previous_month"><input name="myBtn" class="btn btn-info" type="submit" value="Previous Month" onClick="javascript:last_month();"></div>';
echo '<div class="show_month">'.$showmonth.'/'.$showyear.'</div>';
echo '<div class="next_month"><input name="myBtn" class="btn btn-info" type="submit" value="Next Month" onClick="javascript:next_month();"></div>';	
echo '</div>';
echo '<div class="week_days">';
echo '<div class="days_of_week">Sun</div>';
echo '<div class="days_of_week">Mon</div>';
echo '<div class="days_of_week">Tue</div>';
echo '<div class="days_of_week">Wed</div>';
echo '<div class="days_of_week">Thu</div>';
echo '<div class="days_of_week">Fri</div>';
echo '<div class="days_of_week">Sat</div>';
echo '<div class="clear"></div>';
echo '</div>';

//Dispay previous filler days
if ($pre_days != 0) {
	for ($i = 1; $i <= $pre_days; $i++) {
		echo '<div class="non_cal_day"></div>';
	};
}

//Display current month days and events for that day
for ($k = 1; $k <= $day_count; $k++) {
	$date = $showyear."-".$showmonth."-". sprintf("%02d", $k);
	$result = $database->query("SELECT id FROM wb_event_calendar WHERE user_id={$session->user_id} AND event_date LIKE '%{$date}%'");
	$num_rows = $result->num_rows;
	if($num_rows > 0){
		//Insert events to day
		$event = "<input name='$date' type='submit' class='btn btn-success' value='Details' id='$date' onClick='javascript:show_details(this);'>";
	}
	
	if($isCurrentMonth && ($day==$k)){
		echo '<div class="cal_day"style="border: 2px solid red;">';
		echo '<div class="day_heading" >'.$k.'</div>';
	}else{
		echo '<div class="cal_day">';
		echo '<div class="day_heading">'.$k.'</div>';
	}
	
	if($num_rows != 0){
		echo "<div class='openings'><br/>".$event."</div>";
	}
	echo '</div>';
	
}

//Dispaly post month filler days
if($post_days != 0){
	for ($j = 0; $j < $post_days; $j++) {
		echo '<div class="non_cal_day"></div>';
	}
}
echo '</div>';
?>