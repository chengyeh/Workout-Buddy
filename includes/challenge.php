<?php
require_once(LIB_PATH.DS."database.php");
/**
     * The Challenge class contains all the neccesary data to keep track of challenges
     *
     * @param  
     * @return All rows from table are returned
     */
class challenge extends DatabaseObject {
   	protected static $table_name = "challenge";/*!< Name of the table storing all the data associated with this class*/
    protected static $db_fields = array('id','who', 'name', 'bench_press', 'pull_ups', 'treadmill_mileage');/*!< An array keeping track of all member variables of Challenges*/
    public $id;/*!< 11-bit Int to keep track of which the Challenges ID*/
    public $who;/*!<11-bit int to keep track of whose challenege it is using the Users table*/ //retrieve the user_id from the user (unique);
    public $name;/*!< Name of user associated with user_id*/ //the name the user wish to appear
    public $bench_press = 0;/*!< Int to keep track of how many bench presses a user can perform*/
    public $pull_ups = 0; /*!< INt to keep track of how many pull ups a user can perfrom*/

/**
     * Display which three users have the highest benchpress count
     *
     * @param  
     * @return Array containing top three users
     */
    public static function bp_top3(){
      global $database;
      $sql = "SELECT name, bench_press FROM challenge ORDER BY bench_press DESC LIMIT 3;";
      $bp_top3 = $database->query($sql);
      return $bp_top3;
    }
/**
     * Display which three users have the highest pull up count
     *
     * @param  
     * @return Array containing top three users for pull up count
     */
    public static function pu_top3(){
      global $database;
      $sql = "SELECT name, pull_ups FROM challenge ORDER BY pull_ups DESC LIMIT 3;";
      $pu_top3 = $database->query($sql);
      return $pu_top3;
    }
/**
     * Display which three users have the highest threadmill speed
     *
     * @param  
     * @return Array containing top three users
     */
    public static function tm_top3(){
      global $database;
      $sql = "SELECT name, treadmill_mileage FROM challenge ORDER BY treadmill_mileage DESC LIMIT 3;";
      $tm_top3 = $database->query($sql);
      return $tm_top3;
    }
/**
     * Display which 200 users have the highest benchpress count over 200 pounds
     *
     * @param  
     * @return Array containing top three users
     */
    public static function get_BP200(){
      global $database;
    	$sql = "SELECT name, bench_press FROM challenge WHERE bench_press > 200;";
      $bp200 = $database->query($sql);
      return $bp200;
    }


}

?>
