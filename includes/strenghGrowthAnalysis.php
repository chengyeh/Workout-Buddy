<?php
require_once(LIB_PATH.DS."database.php");

class strenghGrowthAnalysis extends DatabaseObject {
    protected static $table_name = "strenghGrowthAnalysis";
    protected static $db_fields = array('id', 'who', 'bench_press_imp', 'bench_press_now', 'bench_press_previous', 'pull_up_imp', 'pull_up_now','pull_up_previous', 'treadmill_imp', 'treadmill_now', 'treadmill_previous');

    public $id;
    public $who;

    //how much the person's strength grow over a period of time
    //now stands for quantity of each category as of now
    //previous stands for what it was before
    //imp stands for improvement; the unit for for this is diff_lbs/days; type float
    public $bench_press_now = 0.0;
    public $bench_press_previous = 0.0;
    public $bench_press_imp = 0.0;
    //how much the person's pull up number grow over a period of time
    public $pull_up_now = 0.0;
    public $pull_up_previous = 0.0;
    public $pull_up_imp = 0.0;
    //////how much the person's Treadmill mileage grow over a period of time
    public $treadmill_now = 0.0;
    public $treadmill_previous = 0.0;
    public $treadmill_imp = 0.0;
}

?>
