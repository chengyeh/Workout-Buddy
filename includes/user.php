<?php
require_once(LIB_PATH.DS."database.php");

class User extends DatabaseObject {

    protected static $table_name="wb_users";
    protected static $db_fields = array('id','first_name','last_name','hashed_password','email','active','activation_code','registration_date');
    public $id;
    public $first_name;
    public $last_name;
    public $hashed_password;
    public $email;
    public $active;
    public $activation_code;
    public $registration_date;
    public $num;

    public static function authenticate($email="", $password=""){
        global $database;
        $email = $database->escape_value($email);
        $password = sha1($database->escape_value($password));

        $sql  = "SELECT * FROM wb_users ";
        $sql .= "WHERE email = '{$email}' ";
        $sql .= "AND hashed_password = '{$password}' ";
        $sql .= "LIMIT 1";

        $result_array = self::find_by_sql($sql);
        if(!empty($result_array)){
            $user = array_shift($result_array);

            if($user->is_active()){
                return $user;
            } else {
                return false;
            }
        }
        else{
            return false;
        }
    }

    public function is_active(){
        if($this->active == 1){
            return true;
        }else{
            return false;
        }

    }

    public function full_name(){
        if(isset($this->first_name) && isset($this->last_name)){
            return $this->first_name . " " . $this->last_name;
        } else {
            return "";
        }
    }

    public function find_groups(){
    	$sql = "SELECT * FROM wb_group WHERE group_owner=".$this->id. " ORDER BY group_name ASC, group_status DESC";
    	$groups_object_array = Group::find_by_sql($sql);
    	return $groups_object_array;
    }

	public function groups_joined(){
    	$sql = "SELECT * FROM wb_group_members WHERE member_id=".$this->id;
    	$group_members_object_array = GroupMember::find_by_sql($sql);
    	return $group_members_object_array;
    }

      public function get_messages()
      {
    	global $database;
    	$a=0;
    	$sql = "SELECT * FROM wb_messages WHERE user=".$this->id." AND del_sent=".$a;
    	$group_message_array = $database->query($sql);
    	return $group_message_array;
      }

      public function receive_messages()
      {
    	global $database;
    	$a=0;
    	$sql = "SELECT * FROM wb_messages WHERE receiver=".$this->id." AND del_receive=".$a;
    	$group_message_array = $database->query($sql);
    	return $group_message_array;
      }

      public function exercises_added()
    {
    	$sql = "SELECT * FROM wb_exercises WHERE x_user_id=".$this->id;
    	$exercise_array = Exercise::find_by_sql($sql);
    	return $exercise_array;
    }

     public function exercise_routines_added()
    {
    	$sql = "SELECT * FROM wb_routine WHERE user_id=".$this->id;
    	$exercise_array = Routine::find_by_sql($sql);
    	return $exercise_array;
    }

    public function find_last_routine()
    {
    	$sql = "SELECT * FROM wb_routine WHERE user_id=".$this->id;
    	$exercise_array = Routine::find_by_sql($sql);
    	return $exercise_array;
    }

    public function find_all_exercises($a,$b)
    {
    	$sql = "SELECT * FROM wb_exercise_set WHERE exercise_id=".$a." AND routine_id=".$b;
    	$exercise_array = Exercises::find_by_sql($sql);
    	return $exercise_array;
    }

    public function find_last_exercise($a)
    {
    	$sql = "SELECT * FROM wb_exercise WHERE routine_id=".$a;
    	$exercise_array = Routine::find_by_sql($sql);
    	return $exercise_array;
    }

	 public function find_type($a)
   {
   		global $database;
    	$sql = "SELECT name FROM wb_exercise_type WHERE id=".$a;
    	$name_type = $database->query($sql);
    	return $name_type;
    }

}

?>
