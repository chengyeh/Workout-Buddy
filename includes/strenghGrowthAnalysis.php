<?php
require_once(LIB_PATH.DS."database.php");

class strenghGrowthAnalysis extends DatabaseObject {
    //how much the person's strength grow over a period of time
    //imp stands for improvement; the unit for for this is diff_lbs/days; type float
    public $bench_press_imp;
    //how much the person's pull up number grow over a period of time
    public $pull_up_imp;
    //////how much the person's Treadmill mileage grow over a period of time
    public $treadmill_imp;
}

?>
