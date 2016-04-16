<?php 
require_once('includes/initialize.php');

$showmonth = $_POST['showmonth'];
$showyear = $_POST['showyear'];

$showmonth = preg_replace('#[^0-9]#i','',$showmonth);
$showmonth = sprintf("%02d", $showmonth);
$showyear = preg_replace('#[^0-9]#i','',$showyear);

$day_count = cal_days_in_month(CAL_GREGORIAN, $showmonth, $showyear);
$pre_days = date('w', mktime(0,0,0,$showmonth,1,$showyear));
$post_days = (6-(date('w', mktime(0,0,0,$showmonth,$day_count,$showyear))));

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
//Previous month filer days
if ($pre_days != 0) {
	for ($i = 1; $i <= $pre_days; $i++) {
		echo '<div class="non_cal_day"></div>';
	};
}
//Current month
for ($k = 1; $k <= $day_count; $k++) {
	$date = $showyear."-".$showmonth."-". sprintf("%02d", $k);
	$result = $database->query("SELECT id FROM wb_event_calendar WHERE user_id={$session->user_id} AND event_date LIKE '%{$date}%'");
	$num_rows = $result->num_rows;
	if($num_rows > 0){
		//Insert events to day
		$event = "<input name='$date' type='submit' class='btn btn-success' value='Details' id='$date' onClick='javascript:show_details(this);'>";
	}
	echo '<div class="cal_day">';
	echo '<div class="day_heading">'.$k.'</div>';
	if($num_rows != 0){
		echo "<div class='openings'><br/>".$event."</div>";
	}
	echo '</div>';
	
}
//Next
if($post_days != 0){
	for ($j = 0; $j < $post_days; $j++) {
		echo '<div class="non_cal_day"></div>';
	}
}
echo '</div>';
?>