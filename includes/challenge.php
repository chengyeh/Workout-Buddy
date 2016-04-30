<?php
require_once(LIB_PATH.DS."database.php");

class challenge extends DatabaseObject {
   	protected static $table_name = "challenge";
    protected static $db_fields = array('id','who', 'name', 'bench_press', 'pull_ups', 'treadmill_mileage');
    public $id;
    public $who; //retrieve the user_id from the user (unique);
    public $name; //the name the user wish to appear
    public $bench_press = 0; //bench press (lbs)
    public $pull_ups = 0; //pull ups (numbers)


    public static function bp_top3(){
      global $database;
      $sql = "SELECT name, bench_press FROM challenge ORDER BY bench_press DESC LIMIT 3;";
      $bp_top3 = $database->query($sql);
      return $bp_top3;
    }

    public static function pu_top3(){
      global $database;
      $sql = "SELECT name, pull_ups FROM challenge ORDER BY pull_ups DESC LIMIT 3;";
      $pu_top3 = $database->query($sql);
      return $pu_top3;
    }

    public static function tm_top3(){
      global $database;
      $sql = "SELECT name, treadmill_mileage FROM challenge ORDER BY treadmill_mileage DESC LIMIT 3;";
      $tm_top3 = $database->query($sql);
      return $tm_top3;
    }

    //testing part
    public static function show_num_bptop3(){
        global $database;
        $sql_1 = "SELECT COUNT(*) FROM challenge ORDER BY bench_press DESC LIMIT 3;";
        $result_1 = $database->query($sql_1);

        $r1 = $result_1->fetch_assoc();
        $n1 = $r1["COUNT(*)"];

        return $n1;
    }
    public static function show_num_putop3(){
        global $database;
        $sql_2 = "SELECT COUNT(*) FROM challenge ORDER BY pull_ups DESC LIMIT 3;";
        $result_2 = $database->query($sql_2);

        $r2 = $result_2->fetch_assoc();
        $n2 = $r2["COUNT(*)"];
        $result_2->free();

        return $n2;
    }
    public static function show_num_tmtop3(){
        global $database;
        $sql_3 = "SELECT COUNT(*) FROM challenge ORDER BY treadmill_mileage DESC LIMIT 3;";
        $result_3 = $database->query($sql_3);

        $r3 = $result_3->fetch_assoc();
        $n3 = $r3["COUNT(*)"];
        $result_3->free();

        return $n3;
    }



}


?>
