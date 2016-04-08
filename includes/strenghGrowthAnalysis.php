<?php
require_once(LIB_PATH.DS."database.php");

class strenghGrowthAnalysis extends DatabaseObject {
    protected static $table_name = "strenghGrowthAnalysis";
    protected static $db_fields = array('id', 'who',

    public $id;
    public $who;

    //how much the person's strength grow over a period of time
    //imp stands for improvement; the unit for for this is diff_lbs/days; type float
    //previous stands for what it was before
    public $bench_press_imp = 0.0;
    public $bench_press_previous = 0.0;
    //how much the person's pull up number grow over a period of time
    public $pull_up_imp = 0.0;
    public $pull_up_previous = 0.0;
    //////how much the person's Treadmill mileage grow over a period of time
    public $treadmill_imp = 0.0;
    public $treadmill_previous = 0.0;


    public static function check_if_user_has_record(){
      global $database;
      $sql = "SELECT * FROM strenghGrowthAnalysis WHERE who LIKE '". $trimmed['user_id'] . "';";
      $check = $database->query($sql);
      return $check;
    }
}

?>
